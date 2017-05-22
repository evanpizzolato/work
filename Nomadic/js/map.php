<?php session_start();
header("Content-type: application/javascript"); 
?>

var customLabel = {
    Accomodations: {
        label: 'R'
    },
    Activities: {
        label: 'B'
    }
};

function locationsMap(user_lat, user_lon, zoom) {
    "use strict";
        if (!user_lat) { user_lat = 20; }
        if (!user_lon) { user_lon = 0; }
        if (!zoom) { zoom = 2; }

    var infoWindow = new google.maps.InfoWindow;
    
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoom,
        center: new google.maps.LatLng(user_lat, user_lon)
    });
    
    
    downloadUrl('xml/locations.xml', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        
        Array.prototype.forEach.call(markers, function(markerElem) {
            var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var link = markerElem.getAttribute('link');
            var type = markerElem.getAttribute('type');
            var imgPath = markerElem.getAttribute('imgPath');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))
            );

            var infoContent = document.createElement('div');
            var infoStyle = document.createAttribute("style");
            infoStyle.value = "max-width: 250px";
            infoContent.setAttributeNode(infoStyle);
            
            var title = document.createElement('h4');
            var strong = document.createElement('a');
            strong.textContent = name + " ";
            var a_strong = document.createAttribute("href");
            a_strong.value = link;
            strong.setAttributeNode(a_strong);
            var t_strong = document.createAttribute("target");
            t_strong.value = "_blank";
            strong.setAttributeNode(t_strong);
            title.appendChild(strong);
            infoContent.appendChild(title);
            
            var img = document.createElement('img');
            var img_content = document.createAttribute('src');
            img_content.value = imgPath;
            img.setAttributeNode(img_content);
            var img_style = document.createAttribute('style');
            img_style.value = "padding: 0 5px 5px 0; width: 45%; float: left";
            img.setAttributeNode(img_style);
            infoContent.appendChild(img);
            
            
            var text = document.createElement('text');
            text.textContent = address;
            infoContent.appendChild(text);
            infoContent.appendChild(document.createElement('br'));
            infoContent.appendChild(document.createElement('br'));
            
            <?php if ($_SESSION["user"]["class"] == 1) {?>
            
            //adding edit button
            var edit = document.createElement('a');
            edit.textContent = "Edit";
            var a_edit = document.createAttribute("href");
            a_edit.value = "locations.php?edit="+id;
            edit.setAttributeNode(a_edit);
            infoContent.appendChild(edit);
            
            var space = document.createElement('span');
            space.textContent = " | ";
            infoContent.appendChild(space);
            
            //adding delete button
            var del = document.createElement('a');
            del.textContent = "Delete";
            var a_del = document.createAttribute("href");
            a_del.value = "locations.php?delete="+id;
            del.setAttributeNode(a_del);
            infoContent.appendChild(del);
            
            <?php }?>
            
            var icon = customLabel[type] || {};

            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });

            marker.addListener('click', function() {
                infoWindow.setContent(infoContent);
                infoWindow.open(map, marker);
            });
        });
    });
    
    function downloadUrl(url,callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
}

function eventsMap(xmlfile, user_lat, user_lon, zoom) {
    "use strict";
    
    if (!xmlfile) { 
        <?php if ($_SESSION["user"]["class"] == 3) {?>
            xmlfile = <?php echo "'".$_SESSION["user"]["id"]."'" ;?>
        <?php } else {?>
            xmlfile = 'events';
        <?php } ?>
    }
    if (!user_lat) { user_lat = 20; }
    if (!user_lon) { user_lon = 0; }
    if (!zoom) { zoom = 2; }

    var infoWindow = new google.maps.InfoWindow;
    
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoom,
        center: new google.maps.LatLng(user_lat, user_lon)
    });
        
    downloadUrl("xml/"+xmlfile+".xml", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');

        Array.prototype.forEach.call(markers, function(markerElem) {
            var name = markerElem.getAttribute('name');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))
            );

            var infoContent = document.createElement('div');
            var infoStyle = document.createAttribute("style");
            infoStyle.value = "max-width: 250px";
            infoContent.setAttributeNode(infoStyle);
            
            var strong = document.createElement('h4');
            strong.textContent = name + " Events";
            infoContent.appendChild(strong);
            
            console.log(markerElem);
            
            var events_block = document.createElement('div');
            
            var events = markerElem.getElementsByTagName('event');
            console.log(events);
            
            for(var i = 0; i < events.length; i++){
                var event_id = events[i].getAttribute("id");
                var event_name = events[i].getAttribute("name");
                var event_url = events[i].getAttribute("link");
                var event_time = events[i].getAttribute("time");
                
                var single_event = document.createElement('div');
                var singleStyle = document.createAttribute("style");
                singleStyle.value = "";
                single_event.setAttributeNode(singleStyle);
                
                var event_title = document.createElement('strong');
                event_title.textContent = event_name;
                single_event.appendChild(event_title);
                
                var span = document.createElement('span');
                var spanStyle = document.createAttribute("style");
                spanStyle.value = "float: right; padding-left: 15px;";
                span.setAttributeNode(spanStyle);
                
                //adding edit button
                var edit = document.createElement('a');
                edit.textContent = "Edit";
                var a_edit = document.createAttribute("href");
                a_edit.value = "events.php?edit="+event_id;
                edit.setAttributeNode(a_edit);
                span.appendChild(edit);

                var space = document.createElement('span');
                space.textContent = " | ";
                span.appendChild(space);

                //adding delete button
                var del = document.createElement('a');
                del.textContent = "Delete";
                var a_del = document.createAttribute("href");
                a_del.value = "events.php?delete="+event_id;
                del.setAttributeNode(a_del);
                span.appendChild(del);
                
                <?php if ($_SESSION["user"]["class"] == 3) {?>
                    single_event.appendChild(span);
                <?php }?>
                
                var event_details = document.createElement('p');
                event_details.textContent = event_time;
                single_event.appendChild(event_details);
                    
                events_block.appendChild(single_event);
            }
            infoContent.appendChild(events_block);
            
            var marker = new google.maps.Marker({
                map: map,
                position: point,
            });

            marker.addListener('click', function() {
                infoWindow.setContent(infoContent);
                infoWindow.open(map, marker);
            });
        });
    });

    function downloadUrl(url,callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
}
