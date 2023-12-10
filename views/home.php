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
        <?php foreach( $params as $key => $param): ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">        
            <?php foreach( $param as $item): ?>
                <td class="px-6 py-4"><?php echo $item['title']; ?></td>
                <td class="px-6 py-4"><?php echo $item['description']; ?></td>
                <td class="px-6 py-4"><?php echo $item['status']; ?></td>
                <td class="px-6 py-4">
                    <?php $form = \app\core\form\Form::begin('/delete', 'get');?>
                        <?php echo $form->button($model, 'id', $item['id'], 'Delete'); ?>
                    <?php \app\core\form\Form::end(); ?>

                    <?php $form = \app\core\form\Form::begin('/edit', 'get');?>
                        <?php echo $form->button($model, 'id', $item['id'], 'Edit'); ?>
                    <?php \app\core\form\Form::end(); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a class="w-36 h-12 bg-green-300 rounded-md" href="/todo">Create ToDo</a>
</div>
    <script src="../js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.remove-todo').click(function(){
                const id = $(this).attr('id');
                alert(id);
            });
        });
    </script>
<?php endif; ?>