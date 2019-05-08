new Vue({
    el: "#body-fronted",
    created: function(){
        this.getCategories();
    },
    data: {
        categorias: [],
        errors: []
    },
    methods: {
        getCategories: function(){
            var url = '/get-categories';
            axios.get(url).then(response =>{
                this.categorias = response.data;
            });
        }
    }
});
