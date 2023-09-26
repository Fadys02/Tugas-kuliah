var application = new Vue({

el:'#barang',

data:{

allData:",

kode:",

nama:",

kategori:",

stok:",

harga:"

methods:{

fetchAllData:function(){

axios.post('action.php', {

action: fetchall

}).then(function(response){

application.allData = response.data;
});

},

submitData:function(){

if(application.kode != " && application.nama != "&& application.kategori != "&&
application.stok != "&& application.harga != "")

axios.post('action.php', {

action:'insert',

kode:application.kode,

nama:application.nama,

kategori:application.kategori,
stok:application.stok,

harga:application.harga

}).then(function(response){

application.fetchAllData();

application.kode = ";

application.nama = ";

application.kategori = ";

application.stok = ";

application.harga = "

alert(response.data.message);

});

}
else

alert("Semua field harus diisi");

}

deleteData:function(id){

if(confirm("Yakin ingin menghapus data?"))

{
  axios.post('action.php', {

action:'delete',

id:id

}).then(function(response){
application.fetchAllData();
alert(response.data.message);

});

}

}

},

created:function(){
this.fetchAllData();

}

}));