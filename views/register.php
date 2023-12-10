<?php
?>

<h1>
    Registration
</h1>

<?php $form = \app\core\form\Form::begin('', 'post'); ?>
  <?php echo $form->field($model, 'name', 'text'); ?>
  <?php echo $form->field($model, 'email', 'text'); ?>
  <?php echo $form->field($model, 'password', 'password'); ?>
  <button type="submit" class="rounded-full w-24 h-12">Submit</button>
<?php \app\core\form\Form::end(); ?>