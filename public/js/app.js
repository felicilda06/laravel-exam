$(document).ready(() => {
    let id = null;

    $("#btn_register").click((e) => {
        e.preventDefault();
        const data = {
            name: $("#name").val(),
            username: $("#username").val(),
            password: $("#password").val(),
        };

        request("/register", "post", data);
    });

    $("#btn_login").click((e) => {
        e.preventDefault();
        const data = {
            username: $("#username").val(),
            password: $("#password").val(),
        };

        request("/login", "post", data);
    });
});

$("#btn_create").click(() => modal("add", "show"));
$("#btn_edit").click(() => {
    id = $("#btn_edit").attr("data-id");
    request(`/announcement/${id}`, "get", {});
    modal("update", "show");
});
$("#btn_remove").click(() => modal("remove", "show"));

$("#btn_close").click(() => modal(["add", "update", "remove"], "hide"));
$("#btn_cancel").click(() => modal("remove", "hide"));

$("#btn_create_announcement").click((e) => {
    e.preventDefault();
    const data = {
        title: $("#title").val(),
        content: $("#content").val(),
        startDate: $("#start_date").val(),
        endDate: $("#end_date").val(),
    };

    const currDate = moment(new Date());
    const start = moment(data.startDate);
    const end = moment(data.endDate);

    if (start.isSameOrBefore(currDate)) {
        data.active = 1;
    }

    request("/announcement/add", "post", data);
});

$("#btn_update_announcement").click((e) => {
    e.preventDefault();
    const data = {
        title: $("#edit_title").val(),
        content: $("#edit_content").val(),
        startDate: $("#edit_startDate").val(),
        endDate: $("#edit_endDate").val(),
    };

    ajax_setup();
    request(`/announcement/${id}`, "put", data);
    modal("update", "hide");
});

$("#btn_confirm_delete").click(() => {
    id = $("#btn_edit").attr("data-id");
    ajax_setup();
    request(`/announcement/${id}`, "delete", {});
});

$("#start_date").change((e) => {
    const value = e.target.value;

    $("#end_date").attr("min", value);
});

const request = (url, method, data) => {
    method = method.toLowerCase();

    $.ajax({
        url,
        method,
        data,
        success: (res) => {
            if (method === "post") {
                if (typeof res === "object") {
                    Swal.fire({
                        icon: "success", // error, success, info, warning
                        // title: "Message",
                        text: res.message,
                    }).then((res) => {
                        if (res.isConfirmed) {
                            clearFields(data);
                            window.location.reload();
                        }
                    });
                } else {
                    window.location.href = "/announcement";
                }
            } else if (method === "get") {
                if (res) {
                    Object.entries(res.announcement).map(([k, v]) => {
                        $(`#edit_${k}`).val(v);
                    });
                }
            } else if (method === "put" || "delete") {
                Swal.fire({
                    icon: "success",
                    text: res.message,
                }).then((res) => {
                    if (res.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        },
        error: (err) => {
            const messages = Object.values(err.responseJSON.message);

            if (typeof err.responseJSON.message === "object") {
                messages.forEach((msg) => {
                    message("error", msg.toString());
                });
            } else {
                message("error", err.responseJSON.message);
            }
        },
    });
};

const message = (type, text) => {
    const theme = {
        success: { background: "#25eb71" },
        warning: { background: "#f0aa29" },
        error: { background: "#f32f2f" },
    };

    return Toastify({
        text,
        // close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: theme[type],
        //onClick: function () {}, // Callback after click
    }).showToast();
};

const clearFields = (obj) => {
    Object.keys(obj).forEach((key) => {
        $(`#${key}`).val("");
    });
};

const modal = (ids, action, data) => {
    if (Array.isArray(ids)) {
        ids.forEach((id) => {
            $(`#${id}`).modal(action);
        });
    } else {
        $(`#${ids}`).modal(action);
    }

    if (data) {
        clearFields(data);
    }
};

const ajax_setup = () => {
    return $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
};

$("#start_date").attr("min", moment().format("YYYY-MM-DD"));
