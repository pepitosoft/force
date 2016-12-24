<?php
$site_base = WIKKA_BASE_URL;
$relative_path = explode( ',', $this->GetConfigValue('action_path'));
$my_action_path = "error_error";

foreach ($relative_path as $key => $value) {
	if ( is_file($value.'/force/d3/d3.v3.min.js') )
  {
			 		$my_action_path = $value.'/force/d3/d3.v3.min.js';
	}
}
echo '<script type="text/javascript" src="'.$my_action_path.'"></script>';
//echo '<button onclick="addNodes()">Restart Animation</button>';
?>

<style>
.link {
    stroke: #2E2E2E;
    stroke-width: 1px;
}

.node {
    stroke: #fff;
    stroke-width: 1px;
}
.textClass {
    stroke: #323232;
    font-family: "Lucida Grande", "Droid Sans", Arial, Helvetica, sans-serif;
    font-weight: normal;
    stroke-width: .1;
    font-size: 10px;
}
</style>

<script>
var graph;
    function myGraph() {

        // Add and remove elements on the graph object
        this.addNode = function (id) {
            nodes.push({"id": id});
            update();
        };

        this.removeNode = function (id) {
            var i = 0;
            var n = findNode(id);
            while (i < links.length) {
                if ((links[i]['source'] == n) || (links[i]['target'] == n)) {
                    links.splice(i, 1);
                }
                else i++;
            }
            nodes.splice(findNodeIndex(id), 1);
            update();
        };

        this.removeLink = function (source, target) {
            for (var i = 0; i < links.length; i++) {
                if (links[i].source.id == source && links[i].target.id == target) {
                    links.splice(i, 1);
                    break;
                }
            }
            update();
        };

        this.removeallLinks = function () {
            links.splice(0, links.length);
            update();
        };

        this.removeAllNodes = function () {
            nodes.splice(0, links.length);
            update();
        };

        this.addLink = function (source, target, value) {
            links.push({"source": findNode(source), "target": findNode(target), "value": value});
            update();
        };

        var findNode = function (id) {
            for (var i in nodes) {
                if (nodes[i]["id"] === id) return nodes[i];
            }
            ;
        };

        var findNodeIndex = function (id) {
            for (var i = 0; i < nodes.length; i++) {
                if (nodes[i].id == id) {
                    return i;
                }
            }
            ;
        };

        // set up the D3 visualisation in the specified element
        var w = 800, h = 400;

        var color = d3.scale.category10();

        var vis = d3.select("#content")
                .append("svg:svg")
                .attr("width", w)
                .attr("height", h)
                .attr("id", "svg")
                .attr("pointer-events", "all")
                .attr("viewBox", "0 0 " + w + " " + h)
                .attr("perserveAspectRatio", "xMinYMid")
                .append('svg:g');

        var force = d3.layout.force();

        var nodes = force.nodes(),
                links = force.links();

        var update = function () {
            var link = vis.selectAll("line")
                    .data(links, function (d) {
                        return d.source.id + "-" + d.target.id;
                    });

            link.enter().append("line")
                    .attr("id", function (d) {
                        return d.source.id + "-" + d.target.id;
                    })
                    .attr("stroke-width", function (d) {
                        return d.value / 10;
                    })
                    .attr("class", "link");
            link.append("title")
                    .text(function (d) {
                        return d.value;
                    });
            link.exit().remove();

            var node = vis.selectAll("g.node")
                    .data(nodes, function (d) {
                        return d.id;
                    });

            var nodeEnter = node.enter().append("g")
                    .attr("class", "node")
                    .call(force.drag);

            nodeEnter.append("svg:circle")
                    .attr("r", 6)
                    .attr("id", function (d) {
                        return "Node;" + d.id;
                    })
                    .attr("class", "nodeStrokeClass")
                    .attr("fill", function(d) { return color(d.id); });

            nodeEnter.append("svg:text")
                    .attr("class", "textClass")
                    .attr("x", 14)
                    .attr("y", ".31em")
                    .text(function (d) {
                        return d.id;
                    });

            node.exit().remove();

            force.on("tick", function () {

                node.attr("transform", function (d) {
                    return "translate(" + d.x + "," + d.y + ")";
                });

                link.attr("x1", function (d) {
                    return d.source.x;
                })
                        .attr("y1", function (d) {
                            return d.source.y;
                        })
                        .attr("x2", function (d) {
                            return d.target.x;
                        })
                        .attr("y2", function (d) {
                            return d.target.y;
                        });
            });

            // Restart the force layout.
            force
                    .gravity(.01)
                    .charge(-80000)
                    .friction(0)
                    .linkDistance( function(d) { return d.value * 10 } )
                    .size([w, h])
                    .start();
        };


        // Make it all go
        update();
    }

    function drawGraph() {

        graph = new myGraph("#svgdiv");

<?php
$page=$this->GetPageTag();
$results = $this->LoadPagesLinkingTo($page);

//print_r($results);
//printf ("graph.addNode('".$results[0][page_tag]."');");

printf ("graph.addNode('".$page."');");
for($i = 0; $i < count($results); $i++) {
	printf ("graph.addNode('".$results[$i][page_tag]."');");
	printf ("graph.addLink('".$page."', '".$results[$i][page_tag]."', '12');\n");
	$results_level_1 = $this->LoadPagesLinkingTo($results[$i][page_tag]);
	for($j = 0; $j < count($results_level_1); $j++) {
		printf ("	graph.addNode('".$results_level_1[$j][page_tag]."');");
		printf ("graph.addLink('".$results[$i][page_tag]."', '".$results_level_1[$j][page_tag]."', '18');\n");
		//$results_level_1 = $this->LoadPagesLinkingTo($results[$i][page_tag]);
	}
}
/*
foreach ($results as $key => $value) {
  for($i = 0; $i < count($value)-1; ++$i) {
    printf ("graph.addNode('".$value[$i]."');");
    printf ("graph.addLink('".$page."', '".$value[$i]."', '6');\n");
    $results_level_1 = $this->LoadPagesLinkingTo($value[$i]);
    foreach ($results_level_1 as $key_level_1 => $value_level_1) {
      for($i = 0; $i < count($value_level_1)-1; ++$i) {
        printf ("     graph.addNode('".$value_level_1[$i]."');");
        printf ("graph.addLink('".$value[$i]."', '".$value_level_1[$i]."', '12');\n");
        $results_level_2 = $this->LoadPagesLinkingTo($value_level_1[$i]);
        foreach ($results_level_2 as $key_level_2 => $value_level_2) {
          for($i = 0; $i < count($value_level_2)-1; ++$i) {
            printf ("       graph.addNode('".$value_level_2[$i]."');");
            printf ("graph.addLink('".$value[$i]."', '".$value_level_2[$i]."', '18');\n");
          }
        }
      }
    }
  }
}
*/
?>
        keepNodesOnTop();
    }

    drawGraph();

    // because of the way the network is created, nodes are created first, and links second,
    // so the lines were on top of the nodes, this just reorders the DOM to put the svg:g on top
    function keepNodesOnTop() {
        d3.selectAll(".nodeStrokeClass").each(function( index ) {
            var gnode = this.parentNode;
            gnode.parentNode.appendChild(gnode);
        });
    }
    function addNodes() {
        d3.select("svg")
                .remove();
         drawGraph();
    }
</script>
