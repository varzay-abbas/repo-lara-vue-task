<template>
    <div class='row'>
        <h1>My Products</h1>
        <h4>New Product</h4>
        <form action="#" @submit.prevent="createProduct()">
            <div class="input-group">
                <input v-model="product.name" type="text" name="product" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Product</button>
                </span>
                <span class="input-group-btn">
                    <button v-if="update_action" @click="updateProduct()" type="button" class="btn btn-primary">Update</button>
                </span>
            </div>
        </form>
        <h4>All Products</h4>
        <div class="row text-center" v-if="loading">
            <rotate-square2></rotate-square2>
        </div>

        <ul class="list-group" v-if="!loading">
            <li v-if='list.length === 0'>There are no Products yet!</li>
            <li class="list-group-item" v-for="(product, index) in list" :key="index">

                {{ product.name }}
                
                <button @click="getProduct(product.id)" class="btn btn-danger btn-xs pull-right" >Update</button>
                 <span style="float:right;"> | </span>
                <button @click="deleteProduct(product.id)" class="mine btn btn-danger btn-xs pull-right " >Delete</button>
                

            </li>
        </ul>
    </div>
</template>

<script>
	import {RotateSquare2} from 'vue-loading-spinner';

	export default {
		components: {
			RotateSquare2
		},
        data() {
            return {
            	loading: true,
                product_id:0,
                update_action : false,
                list: [],
                product: {
                    id: '',
                    name: ''
                    
                }
            };
        },
        props: ['category'],
        created() {
            this.fetchProductList();
        },
        mounted () {
            alert(this.category);
            //this.fetchProductList();

        },
        
        methods: {
            fetchProductList() {
                axios.get('api/products')
                    .then((res) => {
                       // alert("hi");
                            this.list = res.data;
                            this.loading = false;
                    })
			        .catch((err) => console.error(err));;
            },
 
            createProduct() {
                axios.post('api/products', this.product)
                    .then((res) => {
                        this.product.name = '';
                        this.fetchProductList();
                    })
                    .catch((err) => console.error(err));
            },
 
            deleteProduct(id) {
                axios.delete('api/products/' + id)
                    .then((res) => {
                        this.product.name = "";
                        this.product.id = "";

                        this.fetchProductList();

                    })
                    .catch((err) => console.error(err));
            },
            getProduct(id) {
                //alert(id);
                axios.get('api/products/' + id)
                    .then((res) => {
                        //this.fetchProductList()
                       // alert(res.data);
                        console.log(res.data);
                        this.product.name = res.data.name;
                        this.product.id = res.data.id;
                        //this.Product_id = res.data.id;
                        this.update_action = true;

                    })
                    .catch((err) => console.error(err));
            },
            updateProduct() {
                //alert(this.Product_id);
                //this.Product.id = this.Product_id;
                axios.put('api/products/' + this.product.id, this.product)
                    .then((res) => {
                        
                        //alert(res.data);
                        //console.log(res.data);
                       
                        this.product.name = "";
                        this.product.id = "";
                        this.update_action = false;
                         this.fetchProductList();
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>

