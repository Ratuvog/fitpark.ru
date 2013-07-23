<div class="dnone">
    <div class="message-dialog">
        <form id="add-review" action="" method="post">
            <div id="content-title-dialog">
                <div id="content-title-inner-dialog">
                    <h1>Оставь отзыв о клубе</h1>
                </div>
            </div><!--#results-title[END]-->
            <table width="100%" class="window">
                <tr>
                    <td colspan="2" class="hide-text">
                        <p style="height: 20px;"><p>
                    </td>
                </tr>
                <tr>
                    <td class="window-name-options">
                        <p>Имя</p>
                        <input class="checkout-input search" type="text" name="name" isReq="false" text="Имя" validator="blank"/>
                    </td>
                    <td class="window-name-options">
                        <p>Оценка отзыва</p>
                        <select name="type-rewiew" class="add-review-select inline">
                            <option value="1" selected="selected">Положительно</option>
                            <option value="2">Отрицательно</option>
                        </select>
                        <div class="select-arrow add-review-select-arrow"></div>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" class="window-name-options">
                        <p>Отзыв</p>
                        <textarea class="search review-text" name="text" cols="30"  rows="6"  text="Отзыв" validator="blank"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="window-name-options">
                        <p class="pos-review">Плюсы</p>
                    <textarea class="search review-text" name="plus" isReq="false" id="" cols="30" rows="6"  text="Плюсы" validator="blank"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="window-name-options">
                        <p class="neg-review">Минусы</p>
                    <textarea class="search review-text" name="minus" isReq="false" id="" cols="30" rows="6"  text="минусы" validator="blank"></textarea>
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
