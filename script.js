var application = new Vue({
  //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
  el: '#vueApp',
  //dataは　vueの中で使われる変数
  data: {
    insertModal: false,
    loginModal: true,
    allData: '',
    sessionId: '',
    name: '',
    email: '',
    password: '',
    loginName: '',
  },
  methods: {
    // 初回レンダリング時のセッション情報チェック
    sessionCheck: function () {
      axios.post('', {
      }).then(function (res) {
        if (window.sessionStorage.getItem(['loginName']) == null) {
          alert('ログイン情報がありません。ログインして下さい。');
        }else{
          application.loginName = window.sessionStorage.getItem(['loginName']);
          application.loginModal = false;
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
          // application.sessionCheck();
          application.name = "";
          application.password = "";
          application.loginModal = false;
          window.sessionStorage.setItem(['loginName'], [res.data.login_name]);
          application.loginName = res.data.login_name;
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
          application.password = "";
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
    logOut: function () {
      application.loginName = '';
      console.log(window.sessionStorage.getItem(['loginName']))
      window.sessionStorage.clear();
      console.log(window.sessionStorage.getItem(['loginName']))
      alert('ログアウト');
    },
  },

  created: function () {
    this.sessionCheck();
  }
});