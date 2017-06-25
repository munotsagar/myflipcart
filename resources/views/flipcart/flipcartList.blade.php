@extends('layouts.app')

@section('content')
        <style>
            .Product{
    width:220px;
    margin:10px;
    border-style: solid;
        border-width: 1px;
    box-shadow: 1px 1px 5px 5px #888888;
    float:left;
}

.ProductTitle{
    font-size:20px;
    margin:5px;
    color:black;
}

.ProductImage{
    width:200px;
    margin:10px;
    border:1px solid grey;
}

.ProductAmount{
    float:left;
    width:100px;
    text-align:center;
}

.form{
    float:none;
}

.inputText{
  padding: 10px;
  border: solid 5px #c9c9c9;
  box-shadow: inset 0 0 0 1px #707070;
  transition: box-shadow 0.3s, border 0.3s;
}

.queryText{
    font-size:21px;
    color:#333;
    font-family:'Verdana',Arial,sans-serif;
}

.button{
    -webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
    -moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
    box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
    border-bottom-color:#333;
    border:1px solid #61c4ea;
    background-color:#7cceee;
    border-radius:5px;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    color:#333;
    font-family:'Verdana',Arial,sans-serif;
    font-size:14px;
    text-shadow:#b2e2f5 0 1px 0;
    padding:5px;
    cursor:pointer;
}
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    </div>
                @endif

                <div class="content">
                    <div class="title m-b-md">
                        <div class="form">
                            <form>
                                <p class="queryText" >https://affiliate-api.flipkart.net/affiliate/search/json?query=<input class="inputText" placeholder="product name" type="text" name="url" />&resultCount=<input type="text" placeholder="max count" name="count" class="inputText" /></p>
                                
                                <button type="submit" name="sbtn" class="button">Get Result</button>
                            </form>
                        </div>
                    </div>
                    <div>
    <?php if(isset($productInfoList) && count($productInfoList) > 0) 
    { 
        $x = 0;
    
        while($x < count($productInfoList)){
            //print_r($productInfoList[$x]['productBaseInfo']['productAttributes']);
         $title      = $productInfoList[$x]['productBaseInfo']['productAttributes']['title'];
         $amountFake = $productInfoList[$x]['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
         $amountReal = $productInfoList[$x]['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
         $productUrl = $productInfoList[$x]['productBaseInfo']['productAttributes']['productUrl'];
         $imageUrl   = $productInfoList[$x]['productBaseInfo']['productAttributes']['imageUrls']['200x200'];
         ?>
            <a href="<?php echo $productUrl; ?>">
            <div class="Product">
                <p class="ProductTitle"><?php echo $title; ?></p>
                <img class="ProductImage" src="<?php echo $imageUrl; ?>" title="<?php echo $title; ?>" />
                <div class="ProductAmount"><p>Rs <strike><?php echo $amountFake; ?></strike></p></div>
                <div class="ProductAmount"><p>Rs <?php echo $amountReal; ?></p></div>
                <div style="clear:both"></div>
            </div>
            </a>
        <?php  
        $x++;
        }
    }else{
            echo 'No Products';
    } ?>

</div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
@endsection