import 'package:dio/dio.dart' show Dio;
import 'package:flutter/material.dart';
import 'package:flutter_app/blocs/authentication/auth_bloc.dart';
import 'package:flutter_app/blocs/courses/courses_bloc.dart';
import 'package:flutter_app/repositories/auth_repository.dart'
    show AuthRepository;
import 'package:flutter_app/repositories/courses_repository.dart'
    show CoursesRepository;
import 'package:flutter_app/screens/home_screen.dart';
import 'package:flutter_app/screens/login_screen.dart';
import 'package:flutter_app/services/api_service.dart' show ApiService;
import 'package:flutter_bloc/flutter_bloc.dart'
    show BlocProvider, MultiBlocProvider;
import 'package:flutter_secure_storage/flutter_secure_storage.dart'
    show FlutterSecureStorage;

// TODO(simlimone): modifica il baseUrl in api_service.dart prima di avviare

void main() {
  final dio = Dio();
  final secureStorage = FlutterSecureStorage();
  final apiService = ApiService(dio, secureStorage);
  final authRepository = AuthRepository(
    apiService: apiService,
    storage: secureStorage,
  );
  final coursesRepository = CoursesRepository(apiService: apiService);

  runApp(
    MyApp(authRepository: authRepository, coursesRepository: coursesRepository),
  );
}

class MyApp extends StatelessWidget {
  final AuthRepository authRepository;
  final CoursesRepository coursesRepository;

  const MyApp({
    super.key,
    required this.authRepository,
    required this.coursesRepository,
  });

  @override
  Widget build(BuildContext context) {
    return MultiBlocProvider(
      providers: [
        BlocProvider<AuthBloc>(
          create: (_) => AuthBloc(authRepository: authRepository),
        ),
        BlocProvider<CoursesBloc>(
          create: (_) => CoursesBloc(coursesRepository: coursesRepository),
        ),
      ],
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Students CRM APP',
        initialRoute: LoginScreen.routeName,
        routes: {
          LoginScreen.routeName: (context) => const LoginScreen(),
          HomeScreen.routeName: (context) => const HomeScreen(),
        },
      ),
    );
  }
}
