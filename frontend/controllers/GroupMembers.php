<?php

namespace frontend\controllers;
use yii\helpers\Html;
class GroupMembers {

    protected static function renderOffcanvas($students,$courseName,$groupName,$groupNO,$auto)
    {
        // Start building the offcanvas content
        $offcanvasContent = '<div class="offcanvas offcanvas-start bg-dark text-bg-primary " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h6 class="offcanvas-title text-primary" id="offcanvasRightLabel">'.$courseName.'<br>  (Group Members '.count($students).')</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                <div class="text-center text-primary mb-3 p-2">'.$groupName.' (Group NO: '.$groupNO.')'.'</div>
                                    <div class="d-grid gap-3  col-0 w-100">';

        if(count($students) > 0){

            foreach ($students as $student) {
                $offcanvasContent .='<div class="btn btn-outline-primary align-items-start">'.
                '<img src="'.\Yii::$app->request->baseUrl."/profiles/".$student->profileImage.'" class="rounded-4" style="width: 70px;">'.
                Html::button(
                    $student->fname . ' ' . $student->lname . ' - ' . $student->regNo, ['class' => 'btn text-primary w-75'])
    
                    .'</div>';
            }
    
        }else{

            $offcanvasContent .= '<p>No courses available.</p>';
        }                         
        // Loop through students and generate list items
        

        // Close offcanvas body
        $offcanvasContent .= '</div></div></div>';

 
        if($auto){

            $offcanvasContent .= ' <script>
            // Get the modal element
            var modal = document.getElementById("offcanvasRight");
        
            // Execute this function when the modal is hidden (closed)
            modal.addEventListener("hidden.bs.offcanvas", function () {
                // Navigate back to the previous page
                window.history.back();
            });
        </script>
        ';

        }

        // Directly return the offcanvas content HTML
        return $offcanvasContent;
    }

    public static function ShowGroupMembers($students,$courseName,$groupName,$groupNO,$auto = false)
    {
        echo self::renderOffcanvas($students,$courseName,$groupName,$groupNO,$auto);

        // Add the trigger script for showing the offcanvas
        $triggerScript = '<script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function() {
                                var offcanvasElement = document.getElementById("offcanvasRight");
                                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                                offcanvas.show();
                            });
                          </script>';

        if($auto){
            echo $triggerScript;
        }
    }
}
