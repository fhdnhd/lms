<div class="w-full max-w-7xl">
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl p-8 shadow-2xl border-2 border-red-800 w-full">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    {{ isset($user) ? 'Formulir Edit KPPS' : 'Formulir  Tambah KPPS' }}
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                {{-- Kolom kiri --}}
                <div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" 
                                class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Masukkan nama lengkap" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                            <input type="text" name="nik" maxlength="16" value="{{ old('nik', $user->nik ?? '') }}" 
                                class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Nomor Induk Kependudukan" required>
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="2"
                                class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200"
                                placeholder="Alamat lengkap" required>{{ old('alamat', $user->alamat ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. TPS</label>
                                <input type="text" name="tps" value="{{ old('tps', $user->tps ?? '') }}" 
                                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                    placeholder="Nomor TPS" required>
                                <x-input-error :messages="$errors->get('tps')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Desa/Kel</label>
                                <input type="text" name="desa" value="{{ old('desa', $user->desa ?? '') }}" 
                                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                    placeholder="Desa/Kelurahan" required>
                                <x-input-error :messages="$errors->get('desa')" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $user->kecamatan ?? '') }}" 
                                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                    placeholder="Kecamatan" required>
                                <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kab/Kota</label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $user->kabupaten ?? '') }}" 
                                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                    placeholder="Kabupaten/Kota" required>
                                <x-input-error :messages="$errors->get('kabupaten')" class="mt-2" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi ?? '') }}" 
                                class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                                placeholder="Provinsi" required>
                            <x-input-error :messages="$errors->get('provinsi')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Kolom kanan --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                            placeholder="Alamat email" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No WA</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $user->no_wa ?? '') }}" 
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                            placeholder="Nomor WhatsApp" required>
                        <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                    </div>
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="role" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kpps" {{ old('role', $user->role ?? '') == 'kpps' ? 'selected' : '' }}>KPPS</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div> --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" 
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                            placeholder="Buat password" {{ isset($user) ? '' : 'required' }}>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" 
                            class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" 
                            placeholder="Konfirmasi password" {{ isset($user) ? '' : 'required' }}>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-6">
                <button type="submit" class="btn-hover w-full text-white py-3 px-4 rounded-lg font-medium transition-all duration-200 bg-yellow-500 hover:bg-yellow-600">
                    {{ isset($user) ? 'Update User' : 'Buat Akun' }}
                </button>
            </div>
        </div>
    </div>
</div>
