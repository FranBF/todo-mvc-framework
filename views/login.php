<?php
?>
<div class="w-full h-full flex items-center justify-center flex-col">
<h1>
    Login
</h1>
<div clas="flex justify-between h-1/3 w-full">
<?php $form = \app\core\form\Form::begin('', 'post'); ?>
  <?php echo $form->field($model, 'email', 'text'); ?>
  <?php echo $form->field($model, 'password', 'password'); ?>
  <button type="submit" class="rounded-full w-24 h-12 bg-blue-200 mt-4 ml-4">Submit</button>
<?php \app\core\form\Form::end(); ?>
</div>
</div>