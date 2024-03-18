<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/personal/controllers/TaskController.php';

$task = new Task();

// Insert Note
if (isset($_POST['add_task'])) {

    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    //trim the title and content
    $title = trim($title);
    $description = trim($description);
    //trim the title and content

    $title = htmlspecialchars($title);
    $description = htmlspecialchars($description);

    $title = preg_replace('/[###]/', '', $title);
    $description = preg_replace('/[###]/', '', $description);

    $title = preg_replace('/[\*\*]/', '', $title);
    $description = preg_replace('/[\*\*]/', '', $description);

    // here need a function to add line break to the content after each line and full stop

    $res = $task->insert($title, $description, $deadline);
    if ($res) {
        $task->alert_redirect('Tasks Added successfully.', '/personal');

    }
}

// Insert goal
if (isset($_POST['add_goal'])) {

    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    //trim the title and content
    $title = trim($title);
    $description = trim($description);
    //trim the title and content

    $title = htmlspecialchars($title);
    $description = htmlspecialchars($description);

    $title = preg_replace('/[###]/', '', $title);
    $description = preg_replace('/[###]/', '', $description);

    $title = preg_replace('/[\*\*]/', '', $title);
    $description = preg_replace('/[\*\*]/', '', $description);

    // here need a function to add line break to the content after each line and full stop

    $res = $task->insert_goals($title, $description, $deadline);
    if ($res) {
        $task->alert_redirect('Goals Added successfully.', '/personal');

    }
}

// Insert Note
if (isset($_POST['suggest_topic'])) {
    $deadline = $_POST['deadline'] ?? '';
    $content = $_POST['content'] ?? '';
    //trim the title and content
    $deadline = trim($deadline);
    $content = trim($content);
    //trim the title and content

    $deadline = htmlspecialchars($deadline);
    $content = htmlspecialchars($content);



    $deadline = preg_replace('/[###]/', '', $deadline);
    $content = preg_replace('/[###]/', '', $content);

    $deadline = preg_replace('/[\*\*]/', '', $deadline);
    $content = preg_replace('/[\*\*]/', '', $content);

    // here need a function to add line break to the content after each line and full stop

    //add a line break after 10 words including spaces

    //$content = preg_replace('/(\S+\s*){10}/', '$0<br>', $content);

    //make a change here to auto detect the end of a sentence and add a full stop



    $res = $noteController->insert_suggestion($deadline, $content);
    if ($res) {
        $noteController->alert_redirect('Topic Was Suggested Successfully', '/blog');
    }
}

// Update Note
if (isset($_POST['update'])) {

    $id = $_POST['id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    if ($task->update($id, $title, $description, $deadline)) {
        $task->alert_redirect('Task updated successfully.', '/personal');
    } else {
        $task->alert_redirect('Task updated failed.', '/personal');
    }

}

// Update Goal
if (isset($_POST['update_goal'])) {

    $id = $_POST['id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    if ($task->update_goal($id, $title, $description, $deadline)) {
        $task->alert_redirect('Goal updated successfully.', '/personal');
    } else {
        $task->alert_redirect('Goal updated failed.', '/personal');
    }

}

// Update Status
if (isset($_POST['done'])) {
    $id = $_POST['id'] ?? 0;
    if ($task->update_status($id)) {
        //$task->alert_redirect('Task status updated successfully.', '/personal');
        $task->redirect('/personal');
    }
}

// Update goal Status
if (isset($_POST['goal_done'])) {
    $id = $_POST['id'] ?? 0;
    if ($task->update_goal_status($id)) {
        $task->alert_redirect('Goal status updated successfully.', '/personal');
        //$task->redirect('/personal');
    }
}

// Update Status Undo
if (isset($_POST['undo'])) {
    $id = $_POST['id'] ?? 0;
    if ($task->update_status_undo($id)) {
        //$task->alert_redirect('Task status updated successfully.', '/personal');
        $task->redirect('/personal');
    }
}

// Delete Task
if (isset($_POST['delete'])) {
    $id = $_POST['task_id'] ?? 0;
    if ($task->delete($id)) {
        $task->alert_redirect('Task deleted successfully.', '/personal');
    }

}

// Delete Goal
if (isset($_POST['delete_goal'])) {
    $id = $_POST['goal_id'] ?? 0;
    if ($task->delete_goal($id)) {
        $task->alert_redirect('Goal deleted successfully.', '/personal');
    }

}

//fetch the notifcations
/*
if(($_GET['nf'])==1){
     //$task->tasks_notifications();
     $task->setUserTimezone();
}
*/

?>