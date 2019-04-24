@extends('cabinet_admin.index')

@section('scripts')
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/vue.js') }}"></script>
@endsection

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Загрузка данных</h1>
        </div>

        <div class="row justify-content-center" id="app">
            <table class="table">
                <thead>
                    <tr>
                        <td></td>
                        <td>№</td>
                        <td>Информация</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items">
                        <td>
                            @{{ item.ok ? 'OK' : 'ERROR' }}
                        </td>
                        <td>
                            @{{ index + 1 }}
                        </td>
                        <td>
                            @{{ item.ok ? item.data[0] : item.errors[0] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script>
        new Vue({
            el: '#app',
            data: {
                items: [],
                jobId: '{{ $jobId }}'
            },
            methods: {
                load: function () {
                    $.ajax({
                        url: '{{ route('admin.db.get_last_event') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'job_id=' + this.jobId,
                        success: (response) => {
                            if (response) {
                                if (response.data || response.errors) {
                                    this.items.push(response);
                                    console.log(response);
                                }

                                if (response.ok == true && response.finish != true){
                                    setTimeout(this.load, 1500);
                                }
                            } else {
                                console.log('loh');
                            }
                        }
                    });
                }
            },
            beforeMount(){
                this.load()
            },
        })
    </script>

@endsection

