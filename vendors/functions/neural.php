<?php
function display_neural_network($project){
        echo '<div class="col-md-12 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
        <div class="row flex-grow">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div id="mynetwork"></div>
                <script type="text/javascript">
                    let phpNodes ='. json_encode(db_get_neuralNodes($project)) .';
                    let phpEdges =' .json_encode(db_get_neuralEdges($project)) .';
                    var container = document.getElementById("mynetwork");

                    var data = {
                        nodes: phpNodes,
                        edges: phpEdges
                    };

                    var options = {
                        nodes: {
                            shape: "dot",
                            size: 20,
                            borderWidth: 2,
                            font: {
                                size: 14
                            }
                        },
                        edges: {
                            width: 2
                        },
                        groups: {
                            1: {color:{border: "#e00d12", background:"#fb7e81", highlight: {border: "#fd5a77", background: "#ffc0cb"}}, borderWidth:2},
                            2: {color:{border: "#6865fc", background:"#6e6efd", highlight: {border: "#2b7ce9", background: "#97c2fc"}}, borderWidth:2},
                            3: {color:{border: "#64cb2a", background:"#7be141", highlight: {border: "#4ad63a", background: "#c2fabc"}}, borderWidth:2}
                        }
                    }

                    // initialize your network!
                    var network = new vis.Network(container, data, options);
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>';
    }
?>