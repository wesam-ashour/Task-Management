<!-- bundle -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- third party js -->
<script src="{{ asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- third party js ends -->

<!-- demo app -->
<!-- end demo js-->
<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('dashboard') }}", {
            method: 'POST',

            data: {
                _token: '{{ csrf_token() }}',
                id
            }
        });
    }

    $(function () {
        $('.mark-as-read').click(function () {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function () {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>


{{--tasks js yajra-datatable--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function () {

        var table = $('#yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tasks.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'AssignedTo', name: 'AssignedTo.name'},
                {data: 'Client', name: 'Client.name'},
                {data: 'deadline', name: 'deadline'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "language":
                {
                    "sProcessing": "{{ __('sentence.sProcessing') }}",
                    "sLengthMenu": "{{ __('sentence.sLengthMenu') }}",
                    "sZeroRecords": "{{ __('sentence.sZeroRecords') }}",
                    "sInfo": "{{ __('sentence.sInfo') }}",
                    "sInfoEmpty": "{{ __('sentence.sInfoEmpty') }}",
                    "sInfoFiltered": "{{ __('sentence.sInfoFiltered') }}",
                    "sInfoPostFix": "",
                    "sSearch": "{{ __('sentence.sSearch') }}",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "{{ __('sentence.sFirst') }}",
                        "sPrevious": "{{ __('sentence.sPrevious') }}",
                        "sNext": "{{ __('sentence.sNext') }}",
                        "sLast": "{{ __('sentence.sLast') }}"
                    }
                }
        });

    });
</script>

<script>


    function confirmDelete() {
        return confirm('{{ __('sentence.delete_confirm') }}');
    }

</script>

{{--firebase--}}

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyAfKlmgM8TO5SRAXCF6_hgGHuh3zomWf-M",
        authDomain: "push-c4003.firebaseapp.com",
        projectId: "push-c4003",
        storageBucket: "push-c4003.appspot.com",
        messagingSenderId: "362317081774",
        appId: "1:362317081774:web:003628d4761a981026d13f"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function (token) {

            axios.post("{{ route('fcmToken') }}", {
                _method: "PATCH",
                token
            }).then(({data}) => {
                console.log(data)
            }).catch(({response: {data}}) => {
                console.error(data)
            })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage(function ({data: {description, title}}) {
        new Notification(title, {description});
    });
</script>

{{--change Language--}}
<script type="text/javascript">


    var url = "{{ route('changeLang') }}";


    $(".changeLang").change(function () {

        window.location.href = url + "?lang=" + $(this).val();

    });


</script>
