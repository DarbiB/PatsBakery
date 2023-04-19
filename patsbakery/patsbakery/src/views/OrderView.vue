<template>
    <div>
        <orders/>
    </div>

</template>

<script>
import orders from "@/components/OrderList.vue";
export default{
    name: 'OrderView',
    components: {
        orders
    }
}
</script>