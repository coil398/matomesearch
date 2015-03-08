    <script src="/system/js/jquery-2.1.3.min.js"></script>
    <!-- <script src="/js/bootstrap.min.js"></script> -->



    <script>


        reload(); // 初回ロード

        $(function () {
            $('input[name="search"]').keypress(function(ev) {
                if ((ev.which && ev.which === 13) || (ev.keyCode && ev.keyCode === 13)) {
                    reload();
                }
            });
        });

        function reload() {
            $(function () {

                var keyword = $('input[name="search"]').val();


                $.ajax({
                    url: '/index.php/home/search_keyword',
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                })
                .done(function (data) {
                    console.log(data);
                    reloadArticles(data);
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });


                function reloadArticles(data) {
                    var $result = $('.result');

                    var leftUl = "", rightUl = "";

                    var len = data.length;
                    data.forEach(function (o, i) {
                        console.log(i, len)

                        var url = o.Url,
                        title = o.Title, 
                        description = o.Description;

                        var oneLink = 
                            '<li>' + 
                                '<a href="' + url + '">' + title + '</a>' +
                                '<span class="description">' + description + '</span>' +
                            '</li>';

                        if (i < len / 2) {
                            leftUl += oneLink;                        
                        } else {
                            rightUl += oneLink;
                        }
                    });

                    leftUl = '<ul class="left">' + leftUl + '</ul>';
                    rightUl = '<ul class="right">' + rightUl + '</ul>';

                    $result.html(leftUl + rightUl);
                }
            });
        }
    </script>
</body>
</html>
