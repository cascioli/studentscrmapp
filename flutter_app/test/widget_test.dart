// This is a basic Flutter widget test.
//
// To perform an interaction with a widget in your test, use the WidgetTester
// utility in the flutter_test package. For example, you can send tap and scroll
// gestures. You can also use WidgetTester to find child widgets in the widget
// tree, read text, and verify that the values of widget properties are correct.

import 'package:dio/dio.dart' show Dio;
import 'package:flutter/material.dart';
import 'package:flutter_app/repositories/auth_repository.dart'
    show AuthRepository;
import 'package:flutter_app/repositories/courses_repository.dart'
    show CoursesRepository;
import 'package:flutter_app/services/api_service.dart' show ApiService;
import 'package:flutter_secure_storage/flutter_secure_storage.dart'
    show FlutterSecureStorage;
import 'package:flutter_test/flutter_test.dart';

import 'package:flutter_app/main.dart';

void main() {
  final dio = Dio();
  final secureStorage = FlutterSecureStorage();
  final apiService = ApiService(dio, secureStorage);
  final authRepository = AuthRepository(
    apiService: apiService,
    storage: secureStorage,
  );
  final coursesRepository = CoursesRepository(apiService: apiService);

  testWidgets('Counter increments smoke test', (WidgetTester tester) async {
    // Build our app and trigger a frame.
    await tester.pumpWidget(
      MyApp(
        authRepository: authRepository,
        coursesRepository: coursesRepository,
      ),
    );

    // Verify that our counter starts at 0.
    expect(find.text('0'), findsOneWidget);
    expect(find.text('1'), findsNothing);

    // Tap the '+' icon and trigger a frame.
    await tester.tap(find.byIcon(Icons.add));
    await tester.pump();

    // Verify that our counter has incremented.
    expect(find.text('0'), findsNothing);
    expect(find.text('1'), findsOneWidget);
  });
}
