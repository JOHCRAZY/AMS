<?php

namespace frontend\controllers;

use yii\helpers\Html;

class Selector
{

    protected static function renderModal($dataProvider, $ctrAct)
    {
        // Start building the modal content
        $modalContent = '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-center " id="staticBackdropLabel">Select Course</h1>
                                 <!--   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body">
                                    <div class="d-grid gap-2 col-0 w-100">';

        // Check if data provider has models
        if (!empty($dataProvider->models)) {
            // Loop through models and generate course links
            foreach ($dataProvider->models as $course) {
                $modalContent .= Html::a($course->courseName, [$ctrAct, 'courseCode' => $course->courseCode], ['class' => 'btn btn-outline-primary', 'data-dismiss' => 'modal']);
            }
        } else {
            // If no models found, display a message
            $modalContent .= '<p>No courses available.</p>';
        }

        // Close modal body and footer
        $modalContent .= '</div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                </div>
                            </div>
                        </div>
                    </div>';

        // Directly return the modal content HTML
        return $modalContent;
    }

    public static function SelectCourse($dataProvider, $ctrAct = 'course/view')
    {
        echo self::renderModal($dataProvider, $ctrAct);

        $triggerScript = '<script type="text/javascript">
                        document.addEventListener("DOMContentLoaded", function() {
                            var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
                            myModal.show();
                        });
                      </script>';

        echo $triggerScript;
    }

}
