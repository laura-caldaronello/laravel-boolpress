var app = new Vue({
    el: '#root',
    data: {
        'access_token': '7EYkglf7Y0g9zdFQeVU96dECX59pcZEEYQ4V1CtFQY5K7JeADap8ikfbTxayUVyiPrLiPzN4LGl5M0kh',
        'list': []
    },
    created() {
        axios
        .get('http://localhost:8000/api/posts',
            {headers: {
                'Authorization': `Bearer ${this.access_token}`
            }}
        )
        .then((got) => {
            this.list = got.data.results;
            console.log(got.data);
        })
        .catch((error) => {
            console.error(error);
        });                    
    }
});
Vue.config.devtools = true;