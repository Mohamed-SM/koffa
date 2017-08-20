@extends('layouts.app')

@section('title', '| Profile')

@section('content')

<div class="main-content">
                <div class="container-fluid">
                    <div class="panel panel-profile" style="min-height: 520px">
                        <div class="clearfix">
                            <!-- LEFT COLUMN -->
                            <div class="profile-left">
                                <!-- PROFILE HEADER -->
                                <div class="profile-header">
                                    <div class="overlay"></div>
                                    <div class="profile-main">
                                        <img src="http://cssm.edu.jm/data/files/businessman.png" height="100" class="img-circle" alt="Avatar">
                                        <h3 class="name">{{ $user->name.' '.$user->last_name }} </h3>
                                        @foreach($user->roles as $role)
                                        <span class="online-status">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="profile-stat">
                                        <div class="row">
                                            <div class="col-md-4 stat-item">
                                                {{count($user->shops)}}<span>sièges</span>
                                            </div>
                                            <div class="col-md-4 stat-item">
                                            <?php
                                                $koffas = 0;
                                                if(count($user->shops)){
                                                    foreach ($user->shops as $shop) {
                                                        $koffas = $koffas + count($shop->services);
                                                    }    
                                                }
                                                
                                            ?>
                                                {{$koffas}} <span>koffas</span>
                                            </div>
                                            <div class="col-md-4 stat-item">
                                                0 <span>Points</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE HEADER -->
                                <!-- PROFILE DETAIL -->
                                <div class="profile-detail">
                                    <div class="profile-info">
                                        <h4 class="heading">Basic Info</h4>
                                        <ul class="list-unstyled list-justify">
                                            <li>Mobile <span>{{ $user->phone }}</span></li>
                                            <li>Email <span>{{ $user->email }}</span></li>
                                        </ul>
                                    </div>
                                    @if(Auth::user()->id == $user->id or Auth::user()->hasRole('Admin'))
                                    <div class="text-center"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Modifier Profile</a></div>
                                    @endif
                                </div>
                                <!-- END PROFILE DETAIL -->
                            </div>
                            <!-- END LEFT COLUMN -->
                            <!-- RIGHT COLUMN -->
                            <div class="profile-right">
                                @if(count($user->shops))
                                <h4 class="heading">Sièges</h4>
                                <!-- MAP -->
                                <div class="text-center">
                                    <div id="map" style="height: 300px;"></div>
                                </div>
                                <!-- END MAP -->
                                @endif
                                <!-- TABBED CONTENT -->
                                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                                    <ul class="nav" role="tablist">
                                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Projects</a></li>
                                        <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Recent Activity<span class="badge">7</span></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                                        
                                        <div class="table-responsive">
                                            <table class="table project-table">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Progress</th>
                                                        <th>Leader</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">Spot Media</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                                    <span>60% Complete</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user2.png" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
                                                        <td><span class="label label-success">ACTIVE</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">E-Commerce Site</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
                                                                    <span>33% Complete</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
                                                        <td><span class="label label-warning">PENDING</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Project 123GO</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">
                                                                    <span>68% Complete</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
                                                        <td><span class="label label-success">ACTIVE</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Wordpress Theme</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                                                    <span>75%</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user2.png" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
                                                        <td><span class="label label-success">ACTIVE</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Project 123GO</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                                    <span>100%</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle" /> <a href="#">Antonius</a></td>
                                                        <td><span class="label label-default">CLOSED</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Redesign Landing Page</a></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                                    <span>100%</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><img src="assets/img/user5.png" alt="Avatar" class="avatar img-circle" /> <a href="#">Jason</a></td>
                                                        <td><span class="label label-default">CLOSED</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-bottom-left2">
                                        <ul class="list-unstyled activity-timeline">
                                            <li>
                                                <i class="fa fa-comment activity-icon"></i>
                                                <p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2 minutes ago</span></p>
                                            </li>
                                            <li>
                                                <i class="fa fa-cloud-upload activity-icon"></i>
                                                <p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New Year Campaign</a> <span class="timestamp">7 hours ago</span></p>
                                            </li>
                                            <li>
                                                <i class="fa fa-plus activity-icon"></i>
                                                <p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to project repository <span class="timestamp">Yesterday</span></p>
                                            </li>
                                            <li>
                                                <i class="fa fa-check activity-icon"></i>
                                                <p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1 day ago</span></p>
                                            </li>
                                        </ul>
                                        <div class="margin-top-30 text-center"><a href="#" class="btn btn-default">See all activity</a></div>
                                    </div>
                                </div>
                                <!-- END TABBED CONTENT -->
                            </div>
                            <!-- END RIGHT COLUMN -->
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                @if(count($user->shops))
                var map = new GMaps({
                    el: '#map',
                    lat: {{ $user->shops[0]->lat }},
                    lng: {{ $user->shops[0]->lng }},
                    zoom:14
                });
                @foreach($user->shops as $shop)
                map.addMarker({
                    lat: {{ $shop->lat }},
                    lng: {{ $shop->lng }},
                    title: '{{ $shop->title }}',
                    infoWindow: {
                        content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $shop->title }}</b> : {{ $shop->address }}</p><p><span class="lnr lnr-user"></span> {{ $shop->user->name }} {{ $shop->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $shop->user->phone }}</p><div class="text-center"><a href="{{ route('shops.show', $shop->id ) }}" class="btn btn-primary">Voir</a></div></div>'
                    }
                });
                @endforeach
                @endif
            </script>
@endsection