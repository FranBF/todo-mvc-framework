<div class="w-full h-full flex items-center justify-center flex-col">
<h2>ToDo's</h2>

<?php $form = \app\core\form\Form::begin('', 'post'); ?>
  <?php echo $form->field($model, 'title', 'text'); ?>
  <?php echo $form->field($model, 'description', 'text'); ?>
  <button type="submit" class="rounded-full w-24 h-12 bg-green-200 mt-4">Submit</button>
<?php \app\core\form\Form::end(); ?>
</div>