<?php

/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2017-04-10
 * Time: 1:26 PM
 */
class offlineMode
{
    public function saveToPDF()
    {



        /****CAPTURE THE FULL URL PATH ***********/

        // Get HTTP/HTTPS (the possible values for this vary from server to server)
        $myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
        // Get domain portion
        $myUrl .= '://'.$_SERVER['HTTP_HOST'];
        // Get path to script
        $myUrl .= $_SERVER['REQUEST_URI'];
        // Add path info, if any
        if (!empty($_SERVER['PATH_INFO'])) $myUrl .= $_SERVER['PATH_INFO'];
        // Add query string, if any (some servers include a ?, some don't)
        if (!empty($_SERVER['QUERY_STRING'])) $myUrl .= '?'.ltrim($_SERVER['REQUEST_URI'],'?');


        /****END OF CAPTURE ******/


        //Instantiate the class
        $html2pdf = new pdflayer();

        //set the URL to convert
        $html2pdf->set_param('document_url', $myUrl);
        $html2pdf->set_param('orientation', 'landscape');
        $html2pdf->set_param('forms', '1');

        //start the conversion
        $html2pdf->convert();

        //display the PDF file

        return $html2pdf->display_pdf('yourvacation.pdf');


    }
}