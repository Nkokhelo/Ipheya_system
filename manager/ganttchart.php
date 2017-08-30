<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        $logic = new Logic();
   }
   else
   {
     header("Location:../login.php");
   }
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
     <!-- demo stylesheet -->
     <!-- <link type="text/css" rel="stylesheet" href="../assets/ganttchart//layout.css" /> Not sure whether we need this -->
     <!-- helper libraries -->
     <script src="../assets/ganttchart/js/jquery-1.9.1.min.js" type="text/javascript"></script>
     <!-- daypilot libraries -->
     <script src="../assets/ganttchart/js/daypilot/daypilot-all.min.js" type="text/javascript"></script>

      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <h2 class="text-center" style="color:#888">Gantt Chart for <?= $logic->getProjectByNo($_GET['proj'])['project_name'] ?></h2>
              <div class="col-xs-12 ">
                <div class="shadow"></div>
                <div class="hideSkipLink">
                </div>
                <div class="main">
                    <div class="space"></div>
                    <div id="dp"></div>
                </div>
                <div class="clear"></div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script type="text/javascript">
            var dp = new DayPilot.Gantt("dp");
            dp.startDate = new DayPilot.Date("2017-01-01");
            dp.days = 31;

            dp.linkBottomMargin = 5;

            dp.rowCreateHandling = 'Enabled';

            dp.columns = [
                { title: "Name", property: "text", width: 100},
                { title: "Duration", width: 100}
            ];

            dp.onBeforeRowHeaderRender = function(args) {
                args.row.columns[1].html = new DayPilot.Duration(args.task.end().getTime() - args.task.start().getTime()).toString("d") + " days";
                args.row.areas = [
                    {
                        right: 3,
                        top: 3,
                        width: 16,
                        height: 16,
                        style: "cursor: pointer; box-sizing: border-box; background: white; border: 1px solid #ccc; background-repeat: no-repeat; background-position: center center; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABASURBVChTYxg4wAjE0kC8AoiFQAJYwFcgjocwGRiMgPgdEP9HwyBFDkCMAtAVY1UEAzDFeBXBAEgxQUWUAgYGAEurD5Y3/iOAAAAAAElFTkSuQmCC);",
                        action: "ContextMenu",
                        menu: taskMenu,
                        v: "Hover"
                    }
                ];
            };

            dp.contextMenuLink = new DayPilot.Menu([
                {
                    text: "Delete",
                    onclick: function() {
                        var link = this.source;
                        $.post("backend_link_delete.php", {
                            id: link.id()
                        },
                        function(data) {
                            loadLinks();
                        });
                    }
                }
            ]);

            dp.onRowCreate = function(args) {
                $.post("backend_create.php", {
                    name: args.text,
                    start: dp.startDate.toString(),
                    end: dp.startDate.addDays(1).toString()
                },
                function(data) {
                    loadTasks();
                });
            };

            dp.onTaskMove = function(args) {
                $.post("backend_move.php", {
                    id: args.task.id(),
                    start: args.newStart.toString(),
                    end: args.newEnd.toString()
                },
                function(data) {
                    dp.message("Updated");
                });
            };

            dp.onTaskResize = function(args) {
                $.post("backend_move.php", {
                    id: args.task.id(),
                    start: args.newStart.toString(),
                    end: args.newEnd.toString()
                },
                function(data) {
                    dp.message("Updated");
                });
            };


            dp.onRowMove = function(args) {
                $.post("backend_row_move.php", {
                    source: args.source.id,
                    target: args.target.id,
                    position: args.position
                },
                function(data) {
                    dp.message("Updated");
                });
            };

            dp.onLinkCreate = function(args) {
                $.post("backend_link_create.php", {
                    from: args.from,
                    to: args.to,
                    type: args.type
                },
                function(data) {
                    loadLinks();
                });
            };

            dp.onTaskClick = function(args) {
                var modal = new DayPilot.Modal();
                modal.closed = function() {
                    loadTasks();
                };
                modal.showUrl("edit.php?id=" + args.task.id());
            };

            dp.init();

            loadTasks();
            loadLinks();

            function loadTasks() {
                $.post("backend_tasks.php", function(data) {
                    dp.tasks.list = data;
                    dp.update();
                });
            }

            function loadLinks() {
                $.post("backend_links.php", function(data) {
                    dp.links.list = data;
                    dp.update();
                });
            }

            var taskMenu = new DayPilot.Menu({
                items: [
                    {
                        text: "Delete",
                        onclick: function() {
                            var task = this.source;
                            $.post("backend_task_delete.php", {
                                id: task.id()
                            },
                            function(data) {
                                loadTasks();
                            });
                        }
                    }
                ]
            });
            $('#dp div div div:contains("DEMO")').remove();
        </script>