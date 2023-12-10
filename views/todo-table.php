<h2>ToDo's</h2>

<?php $form = \app\core\form\Form::begin('', 'post'); ?>
  <?php echo $form->field($model, 'title'); ?>
  <?php echo $form->field($model, 'description'); ?>
  <button type="submit" class="rounded-full w-24 h-12">Submit</button>
<?php \app\core\form\Form::end(); ?>