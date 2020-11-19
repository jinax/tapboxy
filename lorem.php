<?php
session_start();
if (!isset($_SESSION['nick'])) {
    include_once("include/menuPrincipal.php");
}else{
    include_once("include/menu.php");
}
?>
<div class="lorem">

    <div>
        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis, iusto.</h3>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet sunt excepturi eaque atque, quis architecto iusto nisi impedit tempore fuga dolorum sapiente exercitationem corrupti quaerat maxime, soluta vero animi dolores laboriosam. Repellendus minus rem nemo illo, placeat, dolor quis atque omnis, ullam veritatis reiciendis incidunt ipsa sequi temporibus ipsum tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo natus illo repellendus cum fugit magni consequuntur, rerum impedit cumque, maiores unde reiciendis numquam non aliquid? Harum omnis fugit nobis repellendus!
        </p>
    </div>
    <div>

        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet sunt excepturi eaque atque, quis architecto iusto nisi impedit tempore fuga dolorum sapiente exercitationem corrupti quaerat maxime, soluta vero animi dolores laboriosam. Repellendus minus rem nemo illo, placeat, dolor quis atque omnis, ullam veritatis reiciendis incidunt ipsa sequi temporibus ipsum tempore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque adipisci, aut incidunt fugit reiciendis fugiat quia eius laborum dicta culpa velit labore maiores dignissimos nostrum itaque sequi autem et? Quaerat voluptate mollitia laborum temporibus. Corrupti minus quasi mollitia animi, voluptas error. Ipsum sunt at rem, autem voluptates dolorum dolorem! Nam.
        </p>
    </div>
    <div>
        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet sunt excepturi eaque atque, quis architecto iusto nisi impedit tempore fuga dolorum sapiente exercitationem corrupti quaerat maxime, soluta vero animi dolores laboriosam. Repellendus minus rem nemo illo, placeat, dolor quis atque omnis, ullam veritatis reiciendis incidunt ipsa sequi temporibus ipsum tempore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos impedit recusandae tempora molestias tenetur consectetur porro id esse illo? Doloremque molestias accusamus nemo cupiditate. Facilis fuga obcaecati perferendis quidem neque.
        </p>
    </div>
    <div>
        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet sunt excepturi eaque atque, quis architecto iusto nisi impedit tempore fuga dolorum sapiente exercitationem corrupti quaerat maxime, soluta vero animi dolores laboriosam. Repellendus minus rem nemo illo, placeat, dolor quis atque omnis, ullam veritatis reiciendis incidunt ipsa sequi temporibus ipsum tempore!
        </p>
    </div>

</div>

<?php
include_once("include/footer.php");

?>