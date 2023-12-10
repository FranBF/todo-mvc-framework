<?php 
use app\core\Application;
?>

<?php if(Application::$app->isGuest()) : ?>
    <p>Inicia sesión por favor</p>
<?php else: ?>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <?php $form = \app\core\form\Form::begin('/edit', 'post');?>        
                <td class="px-6 py-4"><?php echo $form->editField($model, 'title', $params[1]['title']); ?></td>
                <td class="px-6 py-4"><?php echo $form->editField($model, 'description', $params[2]['description']); ?></td>
                <td class="px-6 py-4"><?php echo $form->editField($model, 'status', $params[3]['status']); ?></td>
                <td class="px-6 py-4">
                    <?php echo $form->button($model, 'id', $params[5]['id'], 'Update'); ?>
                </td>
                <?php \app\core\form\Form::end(); ?>
        </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>