
    <script src="../../assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        axios.get('../../backend/links.php').then(response => {

           
            lista = []
            console.log(response.data);
            response.data.forEach(dado => {
                obj = new Object();

                obj.title = dado[1];

                obj.value = dado[3];

                lista.push(obj);

            })


            axios.get('../../backend/lista_img.php').then(res => {

                lista_img = []

               
                res.data.forEach(dado => {
                    obj = new Object();

                    obj.title = dado[1];

                    obj.value = dado[3];

                    lista_img.push(obj);

                })


                console.log(lista_img);

                tinymce.init({

                    selector: '.conteudo',
                    plugins: [
                        'advlist autolink link list image print preview hr searchreplace wordcount fullscreen insertdatetime media table paste emoticon'
                    ],
                    link_list: lista,
                    image_list: lista_img,
                    height: 300

                });



            }).catch(erro => {

                cosole.log("erro")

            })

        }).catch(err => {

            console.log(err);
        })
    </script>