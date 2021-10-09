<form action="登録や更新などを行うURL。web.phpで決めたものと同じものを入れる" method="GETかPOSTが入ると考えて当面OK">
　　// csrfは必ず入れる。二重送信対策。@csrfはformタグの中の一番上に入れると無難。
    @csrf
    
    <input type="" name="入力欄に何のデータが入るのかをプログラムに識別してもらうためのものと考える">
　　//同じ項目に対してのラジオボタンやチェックボックスの場合は、nameの中身をそろえる。
　　
　　<textarea name="inputタグの時と同じ"></textarea>
    //textareaタグは複数行入力欄

　　<button>送信ボタン</button>

</form>