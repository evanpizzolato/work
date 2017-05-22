<?php

    class Forum
    {
        private $db;

        public function __construct($db)
        {

            $this->db = $db;
        }

        public function getCategories()
        {
            $query = "select * from forum_categories";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            return $categories;
        }

        public function getCategoryById($category_id)
        {
            $query = "select * from forum_categories where id = :categoryID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryID', $category_id);
            $statement->execute();
            $category = $statement->fetch();
            $statement->closeCursor();
            return $category;   
        }

        public function getTPLPByCategory($category_id)
        {
            $query = "select count(*) as thread from forum_topics where forum_categories_id = :categoryID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryID', $category_id);
            $statement->execute();
            $total = $statement->fetch();
            $statement->closeCursor();

            $query1 = "select count(*) as posts 
                       from forum_replies fr join forum_topics ft on ft.id = fr.forum_topics_id
                       join forum_categories fc on fc.id = ft.forum_categories_id
                       where fc.id = :categoryID";
            
            $statement1 = $this->db->prepare($query1);
            $statement1->bindValue(':categoryID', $category_id);
            $statement1->execute();
            $posts = $statement1->fetch();
            $statement1->closeCursor();

            $query2 = "select ft.id as topicid, fc.id as categoryid, fr.content from forum_replies fr join forum_topics ft on fr.forum_topics_id = ft.id
                       join forum_categories fc on fc.id = ft.forum_categories_id
                       where fc.id = :categoryID
                       order by fr.date desc limit 1";
            $statement2 = $this->db->prepare($query2);
            $statement2->bindValue(':categoryID', $category_id);
            $statement2->execute();
            $lastpost = $statement2->fetch();
            $statement2->closeCursor();


            return array("thread" => $total['thread'], "posts" => $posts['posts'], "lastpost" => $lastpost["content"], "topicid" => $lastpost["topicid"], "categoryid" => $lastpost["categoryid"]);
        }


        public function displayCategories()
        {
            $output = "<div class='row'>
                        <div class='col-sm-4'>
                            <strong>Topics</strong>
                        </div>
                        <div class='col-sm-2'>
                            <strong>Threads</strong>
                        </div>
                        <div class='col-sm-2'>
                            <strong>Posts</strong>
                        </div>
                        <div class='col-sm-4'>
                            <strong>Last Post</strong>
                        </div>";
            foreach($this->getCategories() as $category)
            {
                $stats = $this->getTPLPByCategory($category["id"]);
                $output .= "<div class='row'>";
                $output .= "<div class='col-sm-4'>
                                <a href='?category={$category["id"]}'>".$category["name"]."</a><br />
                                <span>{$category["description"]}</span>
                            </div>";
                $output .= "<div class='col-sm-2'>".$stats["thread"]."</div>";
                $output .= "<div class='col-sm-2'>".$stats["posts"]."</div>";
                $output .= "<div class='col-sm-4'><a href='?category={$stats["categoryid"]}&topic={$stats["topicid"]}'>".$stats["lastpost"]."</a></div>";
                $output .= "</div>";
            }
            $output .= "</div></div>";
            return $output;
        }

        public function getTopics()
        {
            $query = "select * from forum_topics";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $topics = $statement->fetchAll();
            $statement->closeCursor();
            return $topics;
        }
        public function getTopicsByCategories($category_id)
        {
            $query = "select * from forum_topics where forum_categories_id = :categoryID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryID', $category_id);
            $statement->execute();
            $topics = $statement->fetchAll();
            $statement->closeCursor();
            return $topics;
        }

        public function getCategoryAssocWithTopic($topic_id)
        {
            $query = "select * from forum_categories where id = :topicId";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':topicId', $topic_id);
            $statement->execute();
            $topic = $statement->fetch();
            $statement->closeCursor();
            return $topic;
        }

        public function displayTopicsByCategory($category_id)
        {
            //require_once "Votes.php";
            //$votesObject = new Votes($db);

            $output = "<a href='forum.php'>Back To Forum Categories</a>".
                      "<h2>".$this->getCategoryById($category_id)['name']."</h2>";

            $select = "<select name='category'>";
            foreach($this->getCategories() as $category) {
                $select .= "<option value='{$category['id']}'>" . $category['name'] . "</option>";


            }


            $select .= "</select>";

            $output .= "<form method='post'>
                            <input type='text' name='topicTitle' />"
                            .$select.
                            "<br/><input type='submit' name='sbmTopic' value='Add Topic' />".
                       "</form><br/>";


            ////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////            VOTING          ////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////


            foreach($this->getTopicsByCategories($category_id) as $category) {
                $output .= "<div class='row voting' style='padding-bottom: 15px;'>";

                $cookie_name = 'Voting' . $category['id']; // Set up the cookie name

                $output .= '<section class="col-sm-1">';
                if (isset($_COOKIE[$cookie_name])) { // If the cookie exists (means if we have already voted for this article)

                    $output .= '<div class="arrow_up_voted"></div>'; // We display a simple "arrow up", not clickable
                } else {

                    $output .= '<div class="arrow_up" id="arrow_up';
                    $output .= $category['id'];
                    $output .= '"><a href="#" id="arrowUp" onClick="vote(' . $category['id'] . ', \'+1\'); return false;"></a></div>';

                }
                $output .= '<div class="number" id="number' . $category['id'] . '">' . $category['total'] . '</div>'; // We display the number of click

                if (isset($_COOKIE[$cookie_name])) { // If the cookie exists (means if we have already voted for this article)
                    $output .= '<div class="arrow_down_voted"></div>'; // We display a simple "arrow up", not clickable
                } else {

                    $output .= '<div class="arrow_down" id="arrow_down';
                    $output .= $category['id'];
                    $output .= '"><a href="" id="arrowDown" onClick="vote(';
                    $output .= $category['id'];
                    $output .= ', \'-1\'); return false;"></a></div>';

                }
                $output .= '</section>';
                $output .= "<div class='col-sm-9'><span id=\'message" . $category['id'] . "\'></span>
                                <a href='?category={$category_id}&topic={$category["id"]}'>" . $category["title"] . "</a><br />
                            </div>";
                $output .= "<div class='col-sm-2'>" . $category["date"] . "</div>"
                            ."</div>";

            }

            return $output;
        }

        public function createNewTopic($arrayT)
        {
            $title = $arrayT['topicTitle'];
            $category = $arrayT['category'];

            $query = "INSERT INTO `forum_topics`(`title`, `date`, `forum_categories_id`, `users_id`) 
                      VALUES (:title,:dateT,:categoryId,:userId)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':dateT', date("Y-m-d H:i:s"));
            $statement->bindValue(':categoryId', $category);
            $statement->bindValue(':userId', $_SESSION["user"]["id"]);
            $statement->execute();
            $statement->closeCursor();
        }

        public function getTopicReplies($topicId)
        {
            $query = "select * from forum_replies where forum_topics_id = :topicId order by date";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':topicId', $topicId);
            $statement->execute();
            $replies = $statement->fetchAll();
            $statement->closeCursor();
            return $replies;
        }

        public function getUserForReply($userId)
        {
            $query = "select username from users where id = :userId";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userId', $userId);
            $statement->execute();
            $username = $statement->fetch();
            $statement->closeCursor();
            return $username['username'];
        }

        public function createReply($arrayR)
        {
            $query = "insert into forum_replies (content, date, forum_topics_id, users_id)
                      values (:contentValue, :curdate, :topicID, :userId)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':contentValue', $arrayR['content']);
            $statement->bindValue(':curdate', date("Y-m-d H:i:s"));
            $statement->bindValue(':topicID', $arrayR['topicid']);
            $statement->bindValue(':userId', $_SESSION["user"]["id"]);
            $statement->closeCursor();
        }

        public function getTopicNameById($topicId)
        {
            $query = "select title from forum_topics where id = :topicID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':topicID', $topicId);
            $statement->execute();
            $topicname = $statement->fetch();
            $statement->closeCursor();
            return $topicname['title'];
        }

        public function displayTopicReplies($categoryId, $topicId, $pathIndx)
        {
            
            $output = "<a href='?category={$categoryId}'>Back to Topics</a><br />";
            $output .= "<a href='forum.php'>Back to Categories</a>";
            $output .= "<h2>{$this->getTopicNameById($topicId)}</h2><hr />";
            $replies = $this->getTopicReplies($topicId);

            foreach($replies as $reply)
            {
                $output .= "<div>";
                $output .= "<strong>".$this->getUserForReply($reply['users_id'])."</strong><br />";
                $output .= "<p>".$reply['content']."</p>";
                $output .= "<span>Published: ".$reply['date']."</span>";
                $output .= "</div><hr />";
            }
            
            if(isset($pathIndx)){
                $img = "<img height='15' width='15' src='$pathIndx' />";
            }else{
                $img='';
            }
                      

            $sbmReplyForm = "<form method='post'>"; 
            $sbmReplyForm .= "<label>User:" . $_SESSION["user"]["username"] . $img .            
            "</label><br/>";
            $sbmReplyForm .= "<label>Message:</label><br/><textarea name='content'></textarea><br/>";
            $sbmReplyForm .= "<input type='hidden' name='topicid' value='$topicId' />";
            $sbmReplyForm .= "<input type='submit' value='Submit' name='sbmMsg' />";
            $sbmReplyForm .= "</form>";

            $output .= $sbmReplyForm."</div>";
            return $output;
        }
    }

?>