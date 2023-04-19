<template>
    <div>
        <form id="orderForm">
            <fieldset v-bind:class="{validStyle: orderForm.valid, invalidStyle: orderForm.invalid}">
                <legend>New Order</legend>
                <label class="labels"> Order Date: </label><input class="inputs" type="date" v-model="orderForm.date">
                <label class="labels"> Employee Name: </label><input class="inputs" type="text" v-model="orderForm.employeeName">
                <label class="labels"> Customer Name: </label><input class="inputs" type = "text" v-model="orderForm.customerName">
                <label class="labels"> Customer Email or Phone: </label><input class="inputs" type = "text" v-model="orderForm.customerContact">

                <img alt="Small Bread" src="../../src/assets/SmallBread.png" width="185" height="170">

                <fieldset v-bind:class="{validStyle: orderDetailForm.valid, invalidStyle: orderDetailForm.invalid}">
                <legend>New Item</legend>
                    
                    <label for="name">Product Name:</label>
                    <select name="name" id="name" v-model="orderDetailForm.name">
                        <option value="White Bread">White Bread</option>
                        <option value="Wheat Bread">Wheat Bread</option>
                        <option value="White Buns">White Buns</option>
                        <option value="Wheat Buns">Wheat Buns</option>
                        <option value="French Bread">French Bread</option>
                        <option value="Flatbread">Flatbread</option>
                    </select>
                    
                    <label>Quantity:
                        <input type="number" min="1" v-model="orderDetailForm.quantity">
                    </label>
                    
                    <br>
                    <br>
                    <br>

                    <button class="button" type="submit" v-on:click.prevent="addProduct()">Add Item</button>
                </fieldset>

                <table v-if="orderForm.products.length > 0">
                    <tr>
                        <th>Item Name</th>
                        <th>Amount</th>
                    </tr>
                    <tr v-for="order in orderForm.products" :key="order.id">
                        <td>{{ order.name }}</td>
                        <td>{{ order.quantity }}</td>
                    </tr>
                </table>
                

            </fieldset>
            <button class="button" type="submit" v-on:click.prevent="addOrder()">Submit</button>
            <button class="button" v-on:click.prevent="clearOrders()">Clear</button>
        </form>
    </div>
</template>


<script>
import store from '@/store/index.js';

export default {
    name: "add-order",
    data: function(){
        return{
            orderForm: {
                date: "",
                employeeName: "",
                customerName: "",
                customerContact: "",
                id: null,
                products: [],
                valid: false,
                invalid: true
            },
            orderDetailForm: {
                id: null,
                name: "",
                quantity: 1,
                valid: false,
                invalid: true
                
            } 
        }
    },
    // computed: {
    //     session: function() {
    //         return store.state.session;
    //     }
    // },
    methods: {
        addOrder: function() {
            const formdata = new FormData();
            var vm = this;

            //formdata.append("session", this.session);
            formdata.append("date", this.orderForm.date);
            formdata.append("employeeName", this.orderForm.employeeName);
            formdata.append("customerName", this.orderForm.customerName);
            formdata.append("customerContact", this.orderForm.customerContact);
            formdata.append("products", JSON.stringify(this.orderForm.products));


            fetch("http://localhost/Systems Analysis and Design/patsbakery/src/php/addOrder.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.orderForm.date = "";
                    vm.orderForm.employeeName = "";
                    vm.orderForm.customerName = "";
                    vm.orderForm.customerContact = "";
                    vm.orderForm.products = [];

                    vm.$router.push("orders");
                } else {
                    console.log("Error");
                }
            });
        },
        clearOrders: function() {
            store.dispatch("clearOrders");
        },
        
        addProduct: function() {
            this.orderDetailForm.id = this.orderForm.products.length + 1;

            this.orderForm.products.push(Object.assign({},this.orderDetailForm));

            this.orderDetailForm.name = "";
            this.orderDetailForm.quantity = 1;
        }
    },
    
}
</script>
   
   

<style scoped>
    div {
        margin: 25px;
    }
    fieldset {
        background-color: #f2d3a1;
        border: 1px solid #EA3C12;
        width: 600px;;
        margin: auto;
        border-radius: 8px;
        padding: 30px;
        margin-top: 40px;
    }

    legend {
        background-color: #DAB897;
        color: #fc6203;
        padding: 8px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
    }
    .labels {
        display: inline block;
        float: left;
        clear: left;
        width: 200px;
        text-align: right;
        margin-bottom: 10px;
        font-weight: bold;
        color: #8b5220;
        padding: 5px;
    }
    label {
        text-align: right;
        font-weight: bold;
        color: #8b5220;
        padding: 10px;
    }
    .inputs {
        display: inline-block;
        float: left;
    }
    textarea {
        display: inline-block;
    }

    button {
        color: #EFE7DD;
        background-color: #DAB897;
        border-radius: 8px;
        border: none;
        padding: 8px;
        font-size: 16px;
        width: 200px;
        font-weight: bold;
        margin: 10px;
    }
    th{
       color:#8b5220 ;
       padding: 15px;
    }
    td{
       color:#8b5220 ;
       padding: 15px;
    }
    img {
        padding-left: 70px;
    }
    select {
        width:150px;
    }
   
</style>