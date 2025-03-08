import 'package:dio/dio.dart';
import 'package:flutter_app/services/api_service.dart' show ApiService;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class AuthRepository {
  final ApiService apiService;
  final FlutterSecureStorage storage;

  AuthRepository({required this.apiService, required this.storage});

  Future<void> login(String email, String password) async {
    try {
      final response = await apiService.dio.post(
        '/login',
        data: {'email': email, 'password': password},
      );

      final token = response.data['access_token'];
      if (token == null) {
        throw Exception('Token non trovato nella risposta');
      }
      await storage.write(key: 'access_token', value: token);
    } on DioException catch (e) {
      final errorMessage =
          e.response?.data['message'] ?? 'Errore durante il login';
      throw Exception(errorMessage);
    }
  }

  Future<void> logout() async {
    try {
      await apiService.dio.post('/logout');
      await storage.delete(key: 'access_token');
    } on DioException catch (e) {
      final errorMessage =
          e.response?.data['message'] ?? 'Errore durante il logout';
      throw Exception(errorMessage);
    }
  }
}
