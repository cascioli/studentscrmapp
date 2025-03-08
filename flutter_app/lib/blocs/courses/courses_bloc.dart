import 'package:equatable/equatable.dart' show Equatable;
import 'package:flutter_app/models/course.dart' show Course;
import 'package:flutter_app/repositories/courses_repository.dart'
    show CoursesRepository;
import 'package:flutter_bloc/flutter_bloc.dart' show Bloc, Emitter;

part 'courses_event.dart';
part 'courses_state.dart';

class CoursesBloc extends Bloc<CoursesEvent, CoursesState> {
  final CoursesRepository coursesRepository;

  CoursesBloc({required this.coursesRepository}) : super(CoursesInitial()) {
    on<FetchCourses>(_onFetchCourses);
  }

  Future<void> _onFetchCourses(
    FetchCourses event,
    Emitter<CoursesState> emit,
  ) async {
    emit(CoursesLoading());
    try {
      final courses = await coursesRepository.fetchCourses();
      emit(CoursesLoaded(courses));
    } catch (e) {
      emit(CoursesFailure(e.toString()));
    }
  }
}
