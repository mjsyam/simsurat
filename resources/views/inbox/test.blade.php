<form action="{{ route('inbox.disposition', ['letterReceiver' => $letterReceiver->id ]) }}" method="POST">
  @method('POST')
  @csrf

  <div class="container">
      <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
              <div class="letter-content pt-3" style="display: flex;  justify-content: space-between;">
                  <div>
                      <input id="sangatRahasia" type="radio" name="security_level" value="Sangat Rahasia" @if($disposition && $disposition->security_level == "Sangat Rahasia") checked @endif>
                      <label for="sangatRahasia">
                          Sangat Rahasia
                      </label>
                  </div>
                  <div>
                      <input id="rahasia" type="radio" name="security_level" value="Rahasia" @if($disposition && $disposition->security_level == "Rahasia") checked @endif>
                      <label for="rahasia">
                          Rahasia
                      </label>
                  </div>
                  <div>
                      <input id="sangatSegera" type="radio" name="security_level" value="Sangat Segera" @if($disposition && $disposition->security_level == "Sangat Segera") checked @endif>
                      <label for="sangatSegera">
                          Sangat Segera
                      </label>
                  </div>
                  <div>
                      <input id="segera" type="radio" name="security_level" value="Segera" @if($disposition && $disposition->security_level == "Segera") checked @endif>
                      <label for="segera">
                          Segera
                      </label>
                  </div>
                  <div>
                      <input id="biasa" type="radio" name="security_level" value="Biasa" @if($disposition && $disposition->security_level == "Biasa") checked @endif>
                      <label for="biasa">
                          Biasa
                      </label>
                  </div>
              </div>
              <table style="width: 100%">
                  <tbody>
                      <tr>
                          <td>Tanggal Terima</td>
                          <td>:</td>
                          <td>
                              <input type="date" name="receive_date" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->receive_date}} @endif>
                          </td>
                      </tr>
                      <tr>
                          <td>Tanggal Surat</td>
                          <td>:</td>
                          <td>
                              <input type="date" name="purpose" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->purpose}} @endif>
                          </td>
                      </tr>
                      <tr>
                          <td>Asal Surat</td>
                          <td>:</td>
                          <td>
                              <input type="text" name="from" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->from}} @endif>
                          </td>
                      </tr>
                      <tr>
                          <td>Hal</td>
                          <td>:</td>
                          <td>
                              <input type="text" name="point" class="w-100 d-inline" style="border: none; border-bottom: 1px solid #000;" value=@if($disposition) {{$disposition->point}} @endif>
                          </td>
                      </tr>
                  </tbody>
              </table>
              {{-- disposisiton section --}}
              <div class="letter-content" style="margin: 0; padding: 0">
                  <h5>Diteruskan Kepada :</h5>
                  <div class="row">
                      <div class="col-md-6" style="margin-right: 0; padding-right: 0">
                          @if($role1)
                              @foreach ($role1 as $role)
                                  <div class="letter-content">
                                      <input id="role2-{{ $role->id }}" type="checkbox" name="disposition_to[]" value="{{ $role->id }}" @if( $dispositionTos && in_array($role->id, $dispositionTos->toArray())) checked @endif>
                                      <label for="role2-{{ $role->id }}">
                                          {{ $role->name }}
                                      </label>
                                  </div>
                              @endforeach
                          @endif
                      </div>
                      <div class="col-md-6" style="margin-left: 0; padding-left: 0">
                          @if($role2)
                              @foreach ($role2 as $role)
                                  <div class="letter-content">
                                      <input id="role2-{{ $role->id }}" type="checkbox" name="disposition_to[]" value="{{ $role->id }}" @if( $dispositionTos && in_array($role->id, $dispositionTos->toArray())) checked @endif>
                                      <label for="role2-{{ $role->id }}">
                                          {{ $role->name }}
                                      </label>
                                  </div>
                              @endforeach
                          @endif
                      </div>
                  </div>
              </div>
              {{-- information section --}}
              <div class="letter-content" style="margin: 0; padding: 0">
                  <h5>Untuk :</h5>
                  <div class="row">
                      <div class="col-md-6" style="margin-right: 0; padding-right: 0">
                          @foreach ($information1 as $information)
                              <div class="letter-content">
                                  <input id="information1-{{ $information }}" type="checkbox" name="information[]" value="{{ $information }}" @if($informations && in_array($information, $informations->toArray())) checked @endif>
                                  <label for="information1-{{ $information }}">
                                      {{ $information }}
                                  </label>
                              </div>
                          @endforeach
                      </div>
                      <div class="col-md-6" style="margin-left: 0; padding-left: 0">
                          @foreach ($information2 as $information)
                              <div class="letter-content">
                                  <input id="information2-{{ $information }}" type="checkbox" name="information[]" value="{{ $information }}" @if($informations && in_array($information, $informations->toArray())) checked @endif>
                                  <label for="information2-{{ $information }}">
                                      {{ $information }}
                                  </label>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
              {{-- description --}}
              <div class="letter-content">
                  <h5>Keterangan : </h5>
                  <textarea class="form-control" rows="4" name="description">@if($disposition){{$disposition->information}} @endif</textarea>
              </div>
              @if(!$disposition)
                  <div class="text-right my-5">
                      <button class="btn btn-success btn-md">Disposisi</button>
                  </div>
              @endif
          </div>
      </div>

  </div>

</form>
