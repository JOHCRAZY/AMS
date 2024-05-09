<?php

namespace frontend\controllers;

class StudentInfo {

    protected static function renderModal($StudentID)
{
    // Start building the modal content
    $modalContent = '<div class="modal fade text-center " id="StudentInfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="StudentInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-dark m-0 p-0" style="height: 700px">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="StudentInfoModalLabel">Student Information</h5>
                                   <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body">
                                    <iframe class="container rounded-5" src="' . \Yii::getAlias('@web') . '/student/info?StudentID=' . $StudentID . '" width="100%" height="550"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="back" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            $modalContent .= ' <script>
            // Get the modal element
            var modal = document.getElementById("StudentInfoModal");
        
            // Execute this function when the modal is hidden (closed)
            modal.addEventListener("hidden.bs.modal", function () {
                // Navigate back to the previous page
                window.history.back();
            });
        </script>
        ';
            
            // Directly return the modal content HTML
    return $modalContent;
}


    public static function ShowStudentInfo($StudentID)
    {
        echo self::renderModal($StudentID);

        // Add the trigger script for showing the modal
        $triggerScript = '<script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function() {
                                var myModal = new bootstrap.Modal(document.getElementById("StudentInfoModal"));
                                myModal.show();
                            });
                          </script>';

        echo $triggerScript;
    }
}
