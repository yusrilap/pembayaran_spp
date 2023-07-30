@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Guru</li>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Data Guru</div>
                              <a href="{{ url('dashboard/data-guru/create') }}" class="btn btn-success btn-rounded float-right mb-3">
                                 <i class="mdi mdi-plus-circle"></i> {{ __('Tambah Guru') }}
                              </a>
						<div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIP</th>
								    <th scope="col">NAMA</th>
                                            <th scope="col">L/P</th>
                                            <th scope="col">AGAMA</th>
								    <th scope="col">NOMOR TELEPON</th>
								    <th scope="col">ALAMAT</th>
								    <th scope="col"></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@php 
								$i=1;
								@endphp
								@foreach($guru as $value)
                                        <tr>					    
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $value->nisn }}</td>
								    <td>{{ $value->nama }}</td>
                                            <td>{{ $value->jk }}</td>
                                            <td>{{ $value->kelas->agama }}</td>
								    <td>{{ $value->nomor_telp }}</td>
								    <td>{{ $value->alamat }}</td>
                                            <td>										                           
                               	 		  <div class="hide-menu">
                                    			<a href="javascript:void(0)" class="text-dark" id="actiondd" role="button" data-toggle="dropdown">
                                       				<i class="mdi mdi-dots-vertical"></i>
                                    			</a>
                                    				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                        			<a class="dropdown-item" href="{{ url('dashboard/data-siswa/'. $value->id .'/edit') }}"><i class="ti-pencil"></i> Edit </a>
											<form method="post" action="{{ url('dashboard/data-siswa', $value->id) }}" id="delete{{ $value->id }}">
												@csrf
												@method('delete')
												
												<button type="button" class="dropdown-item" onclick="deleteData({{ $value->id }})">
													<i class="ti-trash"></i> Hapus
												</button>	
											
											</form>																																																
                                        			                    							                                                                            
                                				</div>
                            				</div>								
								    </td>					
                                        </tr>
								@php
								$i++;
								@endphp
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>

					  <!-- Pagination -->
					@if($siswa->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $siswa->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $siswa->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $siswa->currentPage() ? 'active' : '' }}" href="{{ $siswa->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $siswa->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($siswa) == 0)
				  			<div class="text-center"> Tidak ada data!</div>
					   @endif
				</div>
			</div>
		</div>
	</div>

@endsection

@section('sweet')

   function deleteData(id){
      Swal.fire({
               title: 'PERINGATAN!',
               text: "Yakin ingin menghapus data siswa? data pembayaran atas nama siswa ini pun akan dihapus jika ada.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
            }).then((result) => {
               if (result.value) {
                     $('#delete'+id).submit();
                  }
               })
   }
   
@endsection