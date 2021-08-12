<form
    action="index.php" 
    method="POST"
    class="form-search"
>
    <label for="searchWord"></label>
    <input
        type="text" 
        class="form-search__input-search border"
        name="searchWord"
        id="searchWord"
        placeholder="Введите текст"
        minlength="3"
        required
        value="<?php
            global $isSearch;
            $value = $isSearch ? $_POST['searchWord'] : '';
            print  $value;
        ?>"
    >
    <button 
        type="submit"
        class="form-search__btn-submit border"
    >
        Найти
    </button>
</form>
    