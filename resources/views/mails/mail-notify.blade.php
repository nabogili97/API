<div>
   <!-- <h2>{{ $data['type'] }}</h2> -->
   <span>Adminさん</span>

   <p>
      比較アイテムシステムからのメッセーです。
   </p>

   <p>
      お客様からメッセージをいただきました。
   </p>

   <p>
      メッセージの内容は下記の通りです。
   </p>

   <p>■名前: {{ $data['name'] }}</p>
   <p>company: {{ $data['company'] }}</p>
   <p>■電話番号：{{ $data['phone'] }}</p>
   <p>category: {{ $data['category'] }}</p>
   <p>email: {{ $data['email'] }}</p>
   <p>type: {{ $data['type'] }}</p>
   <p>■詳細の内容：</p>
   <div style="margin-left: 10px">{!! $data['content'] !!}</div>
   <br>
   <br>

   システムの自動メッセージです。返事しないでお願いいたします。
   <hr>
   <p style="text-align:center">比較アイテム</p>
</div>