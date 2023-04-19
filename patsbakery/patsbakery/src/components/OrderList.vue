<template>
    <div>
       <div v-for="(order, index) in orders" :key="order.id">
           <p><b>Order ID: </b>{{ order.id }}<br>
           <b>Order Date: </b>{{ order.date }}<br>
           <b>Employee Name: </b> {{ order.employeeName }}<br>
           <b>Customer Name: </b>{{ order.customerName }}<br>
           <b>Customer Email or Phone: </b>{{ order.customerContact }}<br></p><br>

           <table id="products" v-if="order.products.length > 0">
               <tr>
                   <th>Product Name</th>
                   <th>Quantity</th>
               </tr>
               <tr v-for="order in order.products" :key="order.id">
                   <td>{{ order.name }}</td>
                   <td>{{ order.quantity }}</td>
               </tr>
           </table>

        
           <hr v-show="index < orders.length -1">
       </div>


   </div>
   
</template>

<script>

export default {
   name: "order-list",
   data: function() {
    return {
        orders: []
    }
   },
   created: function() {
        this.getOrders();    
   },
   methods: {
    getOrders: function() {
        var vm = this;

        fetch("http://localhost/Systems Analysis and Design/patsbakery/src/php/getOrders.php")
        .then(response => response.json())
        .then(function(data){
            vm.orders = data.orders;
        })
    }
   }
   
}
</script>

<style scoped>

h1{
    color: #EA3C12;
    margin-top: 60px;
}
 p{
    color: #8b5220;
    text-align: center;
    width: 800px;
    display: inline-block;
 }

 table{
    margin: auto;
    margin-bottom: 60px;
    border: 2px solid #EA3C12;
    border-radius: 8px;
    
 }
 th{
    color:#8b5220;
    background-color: #ece0d1;
    /* border: 2px solid #811453; */
    }
td{
    color:#EA3C12 ;
}
hr{
    height: 2px;
    background-color: #EA3C12;
    border: none;
}

#products tr:nth-child(odd){background-color: #ece0d1;}
/* #products tr:hover {background-color: #811453; color: white;} */
#products td, #products th {
  /* border: 1px solid #811453; */
  padding: 8px;
  border-radius: 3px;
}
</style>