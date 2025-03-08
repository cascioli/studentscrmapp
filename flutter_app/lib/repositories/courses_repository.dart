import 'dart:developer';

import 'package:dio/dio.dart';
import 'package:flutter_app/services/api_service.dart' show ApiService;
import '../models/course.dart';

class CoursesRepository {
  final ApiService apiService;

  CoursesRepository({required this.apiService});

  Future<List<Course>> fetchCourses() async {
    try {
      final response = await apiService.dio.get('/courses');

      final coursesData = response.data as List;
      return coursesData.map((json) => Course.fromJson(json)).toList();
    } on DioException catch (e) {
      log("Errore: $e");
      final errorMessage =
          e.response?.data['message'] ?? 'Errore nel caricamento dei corsi';
      throw Exception(errorMessage);
    }
  }
}
