<?php
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'SendLoanRequest':
                sendLoanRequest();
                break;
            case 'select':
                select();
                break;
        }
    }

    function select() {
        echo "The select function is called.";
        exit;
    }

    function sendLoanRequest() {
        echo "The insert function is called.";
        exit;
    }
?>