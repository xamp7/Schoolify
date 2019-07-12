@extends('app')

@section('head_page')

@stop


@section('content')

  @include('includes.spinner')

  <div>
    @include('includes.sidebar')

    <div class="page-container">
            @include('includes.topnav')



              <main class="main-content bgc-grey-100">
                  <div id="mainContent">
                      <div class="container-fluid">
                          <!-- <h4 class="c-grey-900 mT-10 mB-30">Attendance</h4> -->
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                      <h4 class="c-grey-900 mB-20">Vue</h4>

                                      <div id="root">

                                          <span><b>Enter Name:</b>  </span>
                                          <input  v-model="newName"  type="text" name="" value="" class="form-control">
                                          <br />
                                          <button type="button" class="btn btn-primary" @click="addName">Add Name</button>
                                          <br />
                                          <br />

                                          <p><b>List:</b></p>
                                          <ul>
                                              <li v-for="name in names"> @{{name}}</li>
                                          </ul>

                                      </div>


                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @include('includes.footer_content')

            @section('footer_page')
              <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

              <script>
                  var app = new Vue({
                      el: '#root',
                      data: {
                          newName: '',
                          names: ['Usman', 'Hassan', 'Sherry']
                      },
                      methods: {
                        addName(){
                          this.names.push(this.newName);
                          this.newName = '';
                        }
                      }
                  });
              </script>

            @stop
        </div>
  </div>


@stop
