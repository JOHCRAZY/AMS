<?php

namespace frontend\controllers;
use yii\helpers\Html;
class StudentList {

    protected static function renderOffcanvas($students)
    {
        // Start building the offcanvas content
        $offcanvasContent = '<div class="offcanvas offcanvas-start bg-dark text-bg-primary " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title text-primary" id="offcanvasRightLabel">All Students</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="d-grid gap-2 col-0 w-100">';

        // Loop through students and generate list items
        foreach ($students as $student) {
            $offcanvasContent .= Html::a($student->fname . ' ' . $student->lname . ' - ' . $student->regNo, ['/groups/info', 'StudentID' => $student->StudentID], ['class' => 'btn btn-outline-primary', 'data-dismiss' => 'modal']);

            //$offcanvasContent .= '<li class="btn btn-outline-primary">' . $student->fname . ' ' . $student->lname . ' - ' . $student->regNo . '</li>';
        }

        // Close offcanvas body
        $offcanvasContent .= '</div></div></div>';

        //     $offcanvasContent .= ' <script>
        //     // Get the modal element
        //     var modal = document.getElementById("offcanvasRight");
        
        //     // Execute this function when the modal is hidden (closed)
        //     modal.addEventListener("hidden.bs.offcanvas", function () {
        //         // Navigate back to the previous page
        //         window.history.back();
        //     });
        // </script>
        // ';

        // Directly return the offcanvas content HTML
        return $offcanvasContent;
    }

    public static function ShowStudentList($students)
    {
        echo self::renderOffcanvas($students);

        // Add the trigger script for showing the offcanvas
        $triggerScript = '<script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function() {
                                var offcanvasElement = document.getElementById("offcanvasRight");
                                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                                offcanvas.show();
                            });
                          </script>';

        echo $triggerScript;
    }
}
?>

<!-- < ?php

namespace frontend\controllers;

class StudentList {

    protected static function renderOffcanvas($students)
    {
        // Start building the offcanvas content
        $offcanvasContent = '<div class="offcanvas offcanvas-start bg-dark text-bg-primary " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title text-primary" id="offcanvasRightLabel">All Students</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="d-grid gap-2 col-0 w-100">';

        // Loop through students and generate list items
        foreach ($students as $student) {
            $offcanvasContent .= '<li class="btn btn-outline-primary">' . $student->fname . ' ' . $student->lname . ' - ' . $student->regNo . '</li>';
        }

        // Close offcanvas body
        $offcanvasContent .= '</div></div></div>';

        // Directly return the offcanvas content HTML
        return $offcanvasContent;
    }

    public static function ShowAllStudents($students)
    {
        echo self::renderOffcanvas($students);

        $triggerScript = '<script type="text/javascript">
                        document.addEventListener("DOMContentLoaded", function() {
                            var myModal = new bootstrap.Modal(document.getElementById("offcanvasRight"));
                            myModal.show();
                        });
                      </script>';

        echo $triggerScript;
    }
}
 -->
