<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light mt-5 mb-3"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    <div class="card card-body bg-light">
        <h2>Edit Post</h2>
        <p>Create a posts with this form</p>
        <form action="<?php echo URLROOT ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
            <div class="form-group mb-3">
                <label for="title">Title <sup>*</sup></label>
                <input type="text" name="title"  class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['title']; ?>">
                <small class="invalid-feedback"><?php echo $data['title_err']; ?></small>
            </div>
            <div class="form-group mb-3">
                <label for="body">body<sup>*</sup></label>
                <textarea  name="body"  class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>" ><?php echo $data['body']; ?></textarea>
                <small class="invalid-feedback"><?php echo $data['body_err']; ?></small>
            </div>
            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>