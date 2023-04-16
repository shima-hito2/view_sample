var application = new Vue({
  //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
  el: '#vueApp',
  //dataは　vueの中で使われる変数
  data: {
    insertModal: false,
    loginModal: false,
    allData:'',
    sessionId:'',
    name:'',
    email:'',
    password:'',
  },
  methods: {
    // 初回レンダリング時のセッション情報チェック
    sessionCheck: function () {
      // do 
      axios.post('./php/sessionCheck.php', {

      }).then(function (res) {
        console.log(res.data['message']);
        if(!res.data['id']){
          alert('ログイン情報がありません。ログインして下さい。');
          application.loginModal = true;
        }
      });
    },
    // ログインチェック
    loginCheck: function () {
      // do 
      axios.post('./php/login.php', {
        name: this.name,
        password: this.password
      }).then(function (res) {
        console.log(res.data.message);
        if (res.data.message == "success") {
          alert("ログインしました");
          application.loginCheck();
          application.name = "";
          application.email = "";
          application.insertModal = false;
        } else {
          alert(res.data.message);
        }
      });
    },
    insertData: function () {
      axios.post('./php/insertUser.php', {
        name: this.name,
        password: this.password
      }).then(function (res) {
        console.log(res.data.message);
        if (res.data.message == "success") {
          alert("登録しました");
          // application.loginCheck();
          application.name = "";
          application.email = "";
          application.insertModal = false;
        } else {
          alert(res.data.message);
        }
      });
    },
    deleteData: function (id) {
      axios.post('./php/delete.php', {
        id: id
      }).then(function (res) {
        console.log(res.data.message);
        if (res.data.message == "success") {
          alert("削除しました");
          application.loginCheck();
          application.name = "";
          application.email = "";
          application.insertModal = false;
        } else {
          alert(res.data.message);
        }
      });
    },
  },

  created: function () {
    this.sessionCheck();
  }
});