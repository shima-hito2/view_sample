var application = new Vue({
  //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
  el: '#vueApp',
  //dataは　vueの中で使われる変数
  data: {
    insertModal: false,
    allData:'',
    name:'',
    email:'',
  },
  methods: {
    fetchAllData: function () {
      // do 
      axios.post('user.php', {

      }).then(function (res) {
        //allDataにphpファイルSELECTの結果が配列で格納される
        application.allData = res.data;
      });
    },
    insertData: function () {
      axios.post('insert.php', {
        name: this.name,
        email: this.email
      }).then(function (res) {
        console.log(res.data.message);
        if (res.data.message == "success") {
          alert("登録しました");
          application.fetchAllData();
          application.name = "";
          application.email = "";
          application.insertModal = false;
        } else {
          alert(res.data.message);
        }
      });
    },
    deleteData: function (id) {
      axios.post('delete.php', {
        id: id
      }).then(function (res) {
        console.log(res.data.message);
        if (res.data.message == "success") {
          alert("削除しました");
          application.fetchAllData();
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
    this.fetchAllData();
  }
});