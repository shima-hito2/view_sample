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

      }).then(function (response) {
        //allDataにphpファイルSELECTの結果が配列で格納される
        application.allData = response.data;
      });
    },
    insertData: function () {
      axios.post('insert.php', {
        name: this.name,
        email: this.email
      }).then(function (response) {
        console.log(response.data.message);
        if (response.data.message == "success") {
          alert("登録しました");
          application.fetchAllData();
          application.name = "";
          application.email = "";
        } else {
          alert(response.data.message);
        }
      });
    },
  },

  created: function () {
    this.fetchAllData();
  }
});