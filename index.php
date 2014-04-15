<?php
    $cur_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'home';
    $nav = json_decode(file_get_contents("site_contents.json"), true);
    $pageheader = $cur_page == 'home' ? 'Shoofly Farm' : $nav['navigation'][$cur_page];
    $pagetitle =($cur_page == 'home' ? 'Shoofly Farm' : "Shoofly Farm - $pageheader");
    $headeritem = $cur_page == 'home' ? '<img id="polaroids" src="images/polaroidHeader.png" id="header"/>' : "<h1
    id='title'>$pageheader</h1>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="google-site-verification" content="aW_N_iGu2dT_z_27YCOwtgv2_5T9TugO4VSDbm_tieQ" />

    <link href='http://fonts.googleapis.com/css?family=Londrina+Sketch' rel='stylesheet' type='text/css'>

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="responsiveslides.min.js"></script>

    <link href="shoofly.css" rel="stylesheet" type="text/css">

    <title><?= $pagetitle ?></title>

    <script>
        $(function() {
            $(".rslides").responsiveSlides({
                auto: false,
                pager: false,
                nav: true,
                maxwidth: "500",
                namespace: "centered-btns"
            });
        });
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-47480557-1', 'shooflyfarm.com');
      ga('send', 'pageview');

    </script>

</head>
<body>
    <header>
        <div class="logocontainer"><a href="index.php" class="logo"></a></div>
        <nav>
            <ul>
                <?php foreach ($nav['navigation'] as $pageid => $title) { ?>
                    <li <?= $cur_page == $pageid ? 'class="current"' : ''; ?> >
                        <a href="/index.php?page=<?= $pageid ?>"><?= $title ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <div id="content">
        <?= $headeritem ?>
        <!-- Begin contents of the page, to be loaded dynamically -->
        <?php
            global $cur_page;
            $key = array_search($pageheader, $nav);
            include_once "$cur_page.php";
        ?>
        <!-- End dynamic content -->
    </div>
    <div id="push"></div>
    <div id="footer">
        <footer><p>Shoofly Farm &copy2013</p></footer>
    </div>
</body>
<script>
    $('#faq article').on('click', function() {
        slide($('.collapsible', this));
    });

    function slide(content) {
        var wrapper = content.parent();
        var contentHeight = content.outerHeight(true);
        var wrapperHeight = wrapper.height();

        wrapper.toggleClass('open');
        if (wrapper.hasClass('open')) {
            setTimeout(function() {
                wrapper.addClass('transition').css('height', contentHeight);
            }, 10);
        }else {
            setTimeout(function() {
                wrapper.css('height', wrapperHeight);
                setTimeout(function() {
                    wrapper.addClass('transition').css('height', 0);
                }, 10);
            }, 10);
        }

        wrapper.one('transitionEnd webkitTransitionEnd transitionend oTransitionEnd msTransitionEnd', function() {
            if(wrapper.hasClass('open')) {
                wrapper.removeClass('transition').css('height', 'auto');
            }
        });
    }

    $(function() {
        $(".rslides").responsiveSlides({
            auto: false,
            pager: false,
            nav: true,
            maxwidth: "500",
            namespace: "centered-btns"
        });
    });
</script>

</html>