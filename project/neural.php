<?php
    if(isset($_GET) && !empty($_GET['id'])){
        include_once '_db_mysql.php';
    }else{
        // redirect
        echo '<script>window.location.replace("index.php");</script>';
    }
?>
<html>
<head>
    <script type="text/javascript" src="../js/vis.min.js"></script>
    <link href="../css/vis.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        #mynetwork {
            width: 1000px;
            height: 800px;
            border: 1px solid lightgray;
            background-color: #222222;
            margin: auto;
        }
    </style>
</head>
<body>
<div id="mynetwork"></div>

<script type="text/javascript">

    let phpNodes = <?php  echo json_encode(db_get_neuralNodes($_GET['id'])); ?>;
    console.log(phpNodes);

    let phpEdges = <?php  echo json_encode(db_get_neuralEdges($_GET['id'])); ?>;
    console.log(phpEdges);

    var container = document.getElementById('mynetwork');

    var data = {
        nodes: phpNodes,
        edges: phpEdges
    };

	var options = {
        nodes: {
            shape: 'dot',
            size: 20,
            borderWidth: 2,
            font: {
                color: '#ffffff',
                size: 14
            }
        },
        edges: {
            width: 2
        },
        groups: {
            1: {color:{border: '#e00d12', background:'#fb7e81', highlight: {border: '#fd5a77', background: '#ffc0cb'}}, borderWidth:2},
            2: {color:{border: '#6865fc', background:'#6e6efd', highlight: {border: '#2b7ce9', background: '#97c2fc'}}, borderWidth:2},
            3: {color:{border: '#64cb2a', background:'#7be141', highlight: {border: '#4ad63a', background: '#c2fabc'}}, borderWidth:2}
        }
	}

    // initialize your network!
    var network = new vis.Network(container, data, options);
</script>
</body>
</html>