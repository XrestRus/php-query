<form 
    action="index.php" 
    method="POST"
    class="form-search"
>
    <input 
        type="text" 
        class="form-search__input-search border"
        name="searchWord"
        id="searchWord"
        placeholder="Введите текст"
        minlength="3"
        required
        value="<?php print $isSearch ? $_POST['searchWord'] : "" ?>"
    >
    <button 
        type="submit"
        class="form-search__btn-submit border"
    >
        Найти
    </button>
</form>
    