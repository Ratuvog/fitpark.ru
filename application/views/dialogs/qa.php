<div class="dnone">
    <div id="add-question" >
        <form method="post">
            <div id="content-title-dialog">
                <div id="content-title-inner-dialog">
                    <h1>Задай вопрос специалисту</h1>
                </div>
            </div><!--#results-title[END]-->
            <table width="100%" class="window">
                <tr>
                    <td colspan="2" class="hide-text">
                        <p>Все поля обязательны для заполнения</p>
                    </td>
                </tr>
<!--                <tr>-->
<!--                    <td colspan="2" class="error-text">-->
<!---->
<!--                    </td>-->
<!--                </tr>-->
                <tr>
                    <td class="window-name-options">Имя</td>
                    <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="user"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">E-mail</td>
                    <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">Текст вопроса</td>
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