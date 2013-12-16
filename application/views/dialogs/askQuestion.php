<div class="dnone">
    <div class="message-dialog">
        <form class="dialog-ajax-form" id="ask-question" action="" method="post">
            <div id="content-title-dialog">
                <div id="content-title-inner-dialog">
                    <h4>Задай вопрос менеджеру</h4>
                </div>
            </div><!--#results-title[END]-->
            <table width="100%" class="window">
                <tr>
                    <td colspan="2" class="hide-text">
                        <p>Заполни все поля, чтобы менеджер мог связаться с тобой<p>
                    </td>
                </tr>
                <tr>
                    <td class="window-name-options">Имя</td>
                    <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="name"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">E-mail</td>
                    <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">Вопрос</td>
                    <td>
                        <textarea class="checkout-input search" style="height: 60px;" name="question" cols="30" rows="10" validator="blank" text="Вопрос"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <div class="button-send button">Отправить</div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>