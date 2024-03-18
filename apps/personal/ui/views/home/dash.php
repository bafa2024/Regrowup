<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/edu/controllers/NoteController.php';
$noteController = new NoteController();
$noteController->checkSessionAndRedirect();
$notes = $noteController->list_notes(); // Assuming this returns an array of notes

include $path . '/apps/edu/ui/layouts/nav.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Note List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Note List</h1>
        <a href="/lab/cms/create" class="btn btn-primary mb-3">Create New Note</a>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content Preview</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $index => $note): ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1; ?></th>
                        <td><?php echo $note['title']; ?></td>
                        <td><?php echo substr($note['content'], 0, 50).'...'; ?></td>
                        <td>
                            <a href="/edu?title=<?php echo $note['title']; ?>" class="btn btn-success">View</a>
                            <a href="/lab/cms/edit?id=<?php echo $note['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="/lab/cms/delete?id=<?php echo $note['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</body>
</html>
<?php
include $path . '/apps/edu/ui/layouts/footer.php';
?>