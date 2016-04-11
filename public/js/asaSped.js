/**
 * 
 */
<script>
        $(function ()
        {
            $("#lefthand-nav").affix({
                offset: {
                    top: function ()
                    {
                        return $("#topbar").outerHeight() + $("#banner").outerHeight();
                    }
                }
            });

            $("#steps-basic, #steps-data, #steps-selection, #steps-keep-selection, #steps-data-api, #steps-command-buttons").steps({
                headerTag: "h4",
                bodyTag: "section",
                enableFinishButton: false,
                enablePagination: false,
                enableAllSteps: true,
                titleTemplate: "#title#",
                cssClass: "tabcontrol"
            });

            prettyPrint();

            $("#init-basic").one("click", function(e)
            {
                e.stopPropagation();
                $(this).remove();
                $("#grid-basic").bootgrid();
            });

            $("#init-data").one("click", function(e)
            {
                e.stopPropagation();
                $(this).remove();
                $("#grid-data").bootgrid({
                    ajax: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    url: "/api/data/basic",
                    formatters: {
                        "link": function(column, row)
                        {
                            return "<a href=\"#\">" + column.id + ": " + row.id + "</a>";
                        }
                    }
                });
            });

            $("#init-selection").one("click", function(e)
            {
                e.stopPropagation();
                $(this).remove();
                $("#grid-selection").bootgrid({
                    ajax: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    url: "/api/data/basic",
                    selection: true,
                    multiSelect: true,
                    formatters: {
                        "link": function(column, row)
                        {
                            return "<a href=\"#\">" + column.id + ": " + row.id + "</a>";
                        }
                    }
                }).on("selected.rs.jquery.bootgrid", function(e, rows)
                {
                    var rowIds = [];
                    for (var i = 0; i < rows.length; i++)
                    {
                        rowIds.push(rows[i].id);
                    }
                    alert("Select: " + rowIds.join(","));
                }).on("deselected.rs.jquery.bootgrid", function(e, rows)
                {
                    var rowIds = [];
                    for (var i = 0; i < rows.length; i++)
                    {
                        rowIds.push(rows[i].id);
                    }
                    alert("Deselect: " + rowIds.join(","));
                });
            });

            $("#init-keep-selection").one("click", function(e)
            {
                e.stopPropagation();
                $(this).remove();
                $("#grid-keep-selection").bootgrid({
                    ajax: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    url: "/api/data/basic",
                    selection: true,
                    multiSelect: true,
                    rowSelect: true,
                    keepSelection: true,
                    formatters: {
                        "link": function(column, row)
                        {
                            return "<a href=\"#\">" + column.id + ": " + row.id + "</a>";
                        }
                    }
                }).on("selected.rs.jquery.bootgrid", function(e, rows)
                {
                    var rowIds = [];
                    for (var i = 0; i < rows.length; i++)
                    {
                        rowIds.push(rows[i].id);
                    }
                    alert("Select: " + rowIds.join(","));
                }).on("deselected.rs.jquery.bootgrid", function(e, rows)
                {
                    var rowIds = [];
                    for (var i = 0; i < rows.length; i++)
                    {
                        rowIds.push(rows[i].id);
                    }
                    alert("Deselect: " + rowIds.join(","));
                });
            });

            $("#init-command-buttons").one("click", function(e)
            {
                e.stopPropagation();
                $(this).remove();
                var grid = $("#grid-command-buttons").bootgrid({
                    ajax: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    url: "/api/data/basic",
                    formatters: {
                        "commands": function(column, row)
                        {
                            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " + 
                                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
                        }
                    }
                }).on("loaded.rs.jquery.bootgrid", function()
                {
                    grid.find(".command-edit").on("click", function(e)
                    {
                        alert("You pressed edit on row: " + $(this).data("row-id"));
                    }).end().find(".command-delete").on("click", function(e)
                    {
                        alert("You pressed delete on row: " + $(this).data("row-id"));
                    });
                });
            });
        });
    </script>